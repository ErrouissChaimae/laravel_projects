<?php
namespace App\Http\Controllers;

use Log;
use App\Models\Ticket;
use App\Models\Autocar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller

{ 
    public function search(Request $request)
    {
         $validatedData = $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $validatedData['query'];

        $tickets = Ticket::with('autocar')->where('code', 'LIKE', "%$query%")->get();
        return view('tickets.index', compact('tickets'))->with('success', 'Tréé avec succès.');;
    }

    
    

    public function index()
    {
        $tickets = Ticket::with('autocar')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $autocars = Autocar::all();
        return view('tickets.create', compact('autocars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_autocar' => 'required|exists:autocars,id_autocar',
            'ville_depart' => 'required|string',
            'ville_arrivee' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'heure_depart' => 'nullable',
            'heure_arrivee' => 'nullable',
            'code' => 'required|integer',
            'quantite_tickets' => 'required|integer',
            'prix' => 'required|numeric',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }

   /* public function show($id_ticket)
    {
        $ticket = Ticket::findOrFail($id_ticket);
        return view('tickets.show', compact('ticket'));
    }*/



    public function edit($id_ticket)
    {
        $ticket = Ticket::findOrFail($id_ticket); 
        $autocars = Autocar::all();
        return view('tickets.edit', compact('ticket', 'autocars'));
    }
    
    
    public function update(Request $request, $id_ticket)
{

    $request->validate([
        'id_autocar' => 'required|exists:autocars,id_autocar',
        'ville_depart' => 'required|string',
        'ville_arrivee' => 'required|string',
        'date' => 'required|date|after_or_equal:today',
        'heure_depart' => 'nullable',
        'heure_arrivee' => 'nullable',
        'code' => 'required|integer',
        'quantite_tickets' => 'required|integer',

        'prix' => 'required|numeric',
    ]);

    $ticket = Ticket::findOrFail($id_ticket);  
    $data = $request->only([
        'id_autocar',
        'ville_depart',
        'ville_arrivee',
        'date',
        'code',
        'quantite_tickets',
        'prix',
    ]);

    if ($request->has('heure_depart')) {
        $data['heure_depart'] = $request->heure_depart;
    }

    if ($request->has('heure_arrivee')) {
        $data['heure_arrivee'] = $request->heure_arrivee;
    }

    $ticket->update($data);

    return redirect()->route('tickets.index')->with('success', 'Ticket mis à jour avec succès.');
}

    


    public function destroy($id_ticket)
    {
        $ticket = Ticket::findOrFail($id_ticket);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket supprimé avec succès.');
    }
}
