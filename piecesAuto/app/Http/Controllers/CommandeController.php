<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Commande;
use App\Models\Article;
use App\Models\Client;
class CommandeController extends Controller
{
    public function index()
{
    $commandes = Commande::with('client', 'article')->get();

    $commandesEnRetard = [];

    foreach ($commandes as $commande) {
        $dateCommande = strtotime($commande->date_commande);
        $dateActuelle = strtotime(now());
        $difference = ($dateActuelle - $dateCommande) / (60 * 60 * 24); 

        if ($difference >= 3) {
            $commandesEnRetard[] = $commande;
        }
    }

    return view('commandes.index', compact('commandes', 'commandesEnRetard'));
}


    public function create()
    {
        $clients = Client::all();
        $articles = Article::all();
        return view('commandes.create', compact('clients', 'articles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id_client',
            'article_id' => 'required|exists:articles,id_article',
            'quantite' => 'required|integer|min:1',
        ]);
    
        $article = Article::findOrFail($request->article_id);
        $prix_unitaire = $article->prix;
        $quantite = $request->quantite;
    
        if ($quantite <= 0) {
            return response()->json(['error' => 'La quantité d\'article doit être supérieure à zéro'], 422);
        }
    
        $prix_total = $prix_unitaire * $quantite;
    
        Commande::create([
            'client_id' => $request->client_id,
            'article_id' => $request->article_id,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
            'prix_total' => $prix_total,
        ]);
    
        return response()->json(['success' => true]);
    }


    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        $clients = Client::all();
        $articles = Article::all();
        return view('commandes.edit', compact('commande', 'clients', 'articles'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id_client',
        'article_id' => 'required|exists:articles,id_article',
        'quantite' => 'required|integer|min:1',
    ]);

    $commande = Commande::findOrFail($id);
    $ancienne_quantite = $commande->quantite;

    if ($commande->article_id !== $request->article_id) {
        $ancien_article = Article::findOrFail($commande->article_id);
        $ancien_article->quantite += $ancienne_quantite;
        $ancien_article->save();

        $nouvel_article = Article::findOrFail($request->article_id);
        $nouvelle_quantite = $nouvel_article->quantite - $request->quantite;

        if ($nouvelle_quantite < 0) {
            return response()->json(['error' => 'Quantité d\'article insuffisante'], 422);
        }

        $nouvel_article->quantite = $nouvelle_quantite;
        $nouvel_article->save();
    } else {
        $diff_quantite = $request->quantite - $ancienne_quantite;
        $article = Article::findOrFail($request->article_id);
        $article->quantite -= $diff_quantite;

        if ($article->quantite < 0) {
            return response()->json(['error' => 'Quantité d\'article insuffisante'], 422);
        }

        $article->save();
    }

    $article = Article::findOrFail($request->article_id);
    $prix_unitaire = $article->prix;
    $prix_total = $prix_unitaire * $request->quantite;

    $commande->update([
        'client_id' => $request->client_id,
        'article_id' => $request->article_id,
        'quantite' => $request->quantite,
        'prix_unitaire' => $prix_unitaire,
        'prix_total' => $prix_total,
    ]);

    return response()->json(['success' => true]);
}


    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès');
    }

    public function rechercher(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
    
        if ($type === 'client') {
            $commandes = Commande::whereHas('client', function ($query) use ($search) {
                $query->where('nom', 'like', '%' . $search . '%')
                      ->orWhere('prenom', 'like', '%' . $search . '%');
            })->get();
        } elseif ($type === 'article') {
            $commandes = Commande::whereHas('article', function ($query) use ($search) {
                $query->where('libele', 'like', '%' . $search . '%');
            })->get();
        } elseif ($type === 'id_commande') {
            $commandes = Commande::where('id_commande', $search)->get();
        } else {
            $commandes = Commande::all();
        }
    
        return view('commandes.index', compact('commandes'));
    }
    
}


