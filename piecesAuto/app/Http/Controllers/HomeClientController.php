<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Client;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;

class HomeClientController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $articles = Article::where('libele', 'like', '%' . $keyword . '%')->get();

    $topArticles = $this->topArticles();

        return view('homes.articlesliste', compact('articles', 'keyword', 'topArticles'));
    }
    public function create(){
        return view('homes.create');
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'required',
            'adresse' => 'required',
            'password' => 'required',
        ]);
        
        $client = Client::create($request->only('nom', 'prenom', 'email', 'telephone', 'adresse', 'password'));

        $request->session()->put('user_email', $request->input('email'));

        
        return response()->json(['success' => true, 'message' => 'Compte créé avec succès!']);
    } catch (\Illuminate\Database\QueryException $ex) {
        if ($ex->errorInfo[1] == 1062) {
            return response()->json(['success' => false, 'message' => 'Email déjà utilisé.']);
        } 
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

    
    public function topArticles()
    {
        $topArticles = Article::select('articles.id_article', 'articles.libele', 'articles.prix', 'articles.quantite', 'articles.photo', DB::raw('SUM(commandes.quantite) as total_quantity'))
            ->join('commandes', 'articles.id_article', '=', 'commandes.article_id')
            ->groupBy('articles.id_article', 'articles.libele', 'articles.prix', 'articles.quantite', 'articles.photo')
            ->orderByDesc('total_quantity')
            ->limit(3)
            ->get();
    
        return $topArticles;
    }
    
    
    public function storecommande(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id_article',
            'quantite' => 'required|integer|min:1',
        ]);
    
        $client_email = $request->session()->get('user_email');
    
        $client = Client::where('email', $client_email)->first();
    
        if (!$client) {
            return response()->json(['error' => 'Client non trouvé'], 404);
        }
    
        $article = Article::findOrFail($request->article_id);
        $prix_unitaire = $article->prix;
        $quantite = $request->quantite;
    
        if ($quantite <= 0) {
            return response()->json(['error' => 'La quantité d\'article doit être supérieure à zéro'], 422);
        }
        $article = Article::findOrFail($request->input('article_id'));
        $quantite_commandee = $request->input('quantite');

        if ($quantite_commandee > $article->quantite) {
            return response()->json(['success' => false, 'message' => 'La quantité commandée dépasse la quantité en stock.']);
        }
    
        $prix_total = $prix_unitaire * $quantite;
    
        Commande::create([
            'client_id' => $client->id_client,
            'article_id' => $request->article_id,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
            'prix_total' => $prix_total,
        ]);
    
        return response()->json(['success' => true, 'message' => 'Commande ajoutée avec succès!']);
    }    
    public function mesCommandes(Request $request)
    {
        $client_email = session('user_email');

        $client = Client::where('email', $client_email)->first();
    
    
        if (!$client) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à vos commandes.');
    
        } 
        $commandes = Commande::where('client_id', $client->id_client)->get();

    return view('homes.mes-commandes', compact('commandes'));
    }
    
    public function showProfile(Request $request)
    {
        $client_email = session('user_email');
    
        $client = Client::where('email', $client_email)->first();
    
        if (!$client) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à votre profil.');
        }
    
        return view('homes.profile', compact('client'));
    }
    public function editProfile(Request $request)
    {
        $client_email = session('user_email');
    
        $client = Client::where('email', $client_email)->first();
    
        if (!$client) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à votre profil.');
        }
    
        return view('homes.edit-profile', compact('client'));
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
        ]);
    
        $client_email = session('user_email');
    
        Client::where('email', $client_email)->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'telephone' => $request->input('telephone'),
            'adresse' => $request->input('adresse'),
        ]);
    
        return redirect()->route('client.profile')->with('success', 'Profil mis à jour avec succès!');
    }
        
}
