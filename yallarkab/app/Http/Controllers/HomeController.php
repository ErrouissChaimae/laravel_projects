<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $tickets = collect();
        
        return view('home', compact('tickets'));
    }

    /**
     * Search for tickets.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // app/Http/Controllers/HomeController.php


    public function search(Request $request)
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

        $tickets = $query->with('autocar')->paginate(5);

        return view('home', compact('tickets'));
    }

}


