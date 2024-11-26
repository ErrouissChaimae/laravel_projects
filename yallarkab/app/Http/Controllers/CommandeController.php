<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function create($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('commandes.create', compact('ticket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ticket' => 'required|exists:tickets,id_ticket',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ], [
            'children.filled' => 'Le champ Enfants est requis.',
        ]);
        
        if (!$request->filled('children')) {
            $request->merge(['children' => 0]);
        }
        
        


      

        $ticket = Ticket::find($request->id_ticket);
        $quantite = $request->adults + $request->children;

        if (!$ticket->placesRestantes($quantite)) {
            return redirect()->back()->with('error', 'Pas assez de tickets disponibles.');
        }

        $prix_total = ($request->adults * $ticket->prix) + ($request->children * $ticket->prix * 0.5);

        $commande = new Commande();
        $commande->id_ticket = $request->id_ticket;
        $commande->id_client = auth()->user()->id;
        $commande->adults = $request->adults;
        $commande->children = $request->children;
        $commande->quantite = $quantite;
        $commande->prix_total = $prix_total;
        $commande->save();

        $ticket->quantite_tickets -= $quantite;
        $ticket->save();

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès');
    }
//panier
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir vos commandes.');
        }

        $commandes = Commande::where('id_client', auth()->user()->id)->with('ticket.autocar')->paginate(2);;
        return view('commandes.index', compact('commandes'));
    }


    public function destroy($id_commande)
    {
        $commande = Commande::findOrFail($id_commande);
        $commande->delete();

        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }
//index de admin
    public function all()
    {

        $commandes = Commande::with('ticket.autocar', 'client')->paginate(10);
        return view('commandes.all', compact('commandes'));
    }

    public function deletePastOrder($id_commande)
    {

        $commande = Commande::findOrFail($id_commande);

        if ($commande->ticket->date >= now()) {
            return redirect()->route('commandes.all')->with('error', 'You can only delete past orders.');
        }

        $commande->delete();

        return redirect()->route('commandes.all')->with('success', 'Past order deleted successfully.');
    }

    public function search(Request $request)
{
    $validatedData = $request->validate([
        'query' => 'required|string|max:255',
    ]);

    $query = $validatedData['query'];

    $commandes = Commande::with('ticket', 'client')
        ->whereHas('ticket', function ($q) use ($query) {
            $q->where('id_ticket', 'LIKE', "%$query%");
        })
        ->orWhereHas('client', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%")
              ->orWhere('cin', 'LIKE', "%$query%");
        })
        ->paginate(10);

    return view('commandes.all', compact('commandes'));
}

}
