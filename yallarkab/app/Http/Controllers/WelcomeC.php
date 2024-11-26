<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Autocar;
use Illuminate\Http\Request;

class WelcomeC extends Controller
{
    public function index()
    {
        $autocars = Autocar::pluck('nom', 'id_autocar')->toArray();

        $tickets = Ticket::paginate(3);
        $tickets=collect();

        return view('welcome', compact('tickets', 'autocars'));
    }
    
     
    public function search1(Request $request)
    {
        $query = Ticket::query();
    
        if ($request->filled('ville_depart')) {
            $query->where('ville_depart', 'like', '%' . $request->ville_depart . '%');
        }
    
        if ($request->filled('ville_arrivee')) {
            $query->where('ville_arrivee', 'like', '%' . $request->ville_arrivee . '%');
        }
    
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
    
        $tickets = $query->with('autocar')->paginate(3);
    
        $autocars = Autocar::pluck('nom', 'id_autocar')->toArray();
    
        $request->session()->put('filters', $request->except('_token'));
    
        return view('welcome', compact('tickets', 'autocars'));
    }
    
    public function filterTickets(Request $request)
    {
        $filters = $request->session()->get('filters', []);
    
        $query = Ticket::query()->where($filters);
    
        if ($request->filled('autocar')) {
            $query->whereIn('id_autocar', $request->autocar);
        }
    
        $tickets = $query->with('autocar')->paginate(3);
    
        $autocars = Autocar::pluck('nom', 'id_autocar')->toArray();
    
        return view('welcome', compact('tickets', 'autocars'));
    }
    
    


}
