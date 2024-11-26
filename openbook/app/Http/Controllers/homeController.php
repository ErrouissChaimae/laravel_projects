<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oeuvre;
use App\Models\Achat;
use App\Models\Membre;
use App\Models\Reservation;
use App\Models\Personne;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class homeController extends Controller
{
    public function index()
    {
        $oeuvres = Oeuvre::all();
        $genres = Oeuvre::distinct('genre')->pluck('genre');

        return view('index', compact('oeuvres', 'genres'));
    }

    public function hshow($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);

        // Récupérer les autres œuvres du même genre
        $sameGenreWorks = Oeuvre::where('genre', $oeuvre->genre)
                                ->where('id_livre', '!=', $id) // Exclure l'œuvre actuelle
                                ->get();

        // Récupérer les autres œuvres du même auteur
        $sameAuthorWorks = Oeuvre::where('auteur', $oeuvre->auteur)
                                ->where('id_livre', '!=', $id) // Exclure l'œuvre actuelle
                                ->get();

        return view('show', compact('oeuvre', 'sameGenreWorks', 'sameAuthorWorks'));
    }
    


    public function topVentes()
    {
        $topVentes = Oeuvre::withCount('achats')->orderByDesc('achats_count')->take(3)->get();
        $oeuvres = Oeuvre::all();

        return view('home', compact('topVentes', 'oeuvres'));
    }

    public function allOeuvres()
    {
        $oeuvres = Oeuvre::all();
        return view('home', compact('oeuvres'));
    }
    
    public function show()
{
    $user = Auth::user();
    $achats = Achat::where('id_pers', $user->id_pers)->with('oeuvre')->get();
    
    if ($user->membre) {
        $reservations = Reservation::where('id_pers', $user->id_pers)->with('oeuvre')->get();
    } else {
        $reservations = collect(); // Empty collection if not a member
    }

    return view('profile', compact('user', 'achats', 'reservations'));
}
public function edit()
{
    $user = Auth::user();
    return view('edit_profile', compact('user'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'cin' => 'required|unique:personnes,cin,' . $id . ',id_pers',
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email|unique:personnes,email,' . $id . ',id_pers',
        'tel' => 'required',
        'adresse' => 'required',
    ]);

    $personne = Personne::findOrFail($id);
    $data = $request->all();

    if ($request->filled('password')) {
        $request->validate(['password' => 'min:8']);
        $data['password'] = bcrypt($request->password);
    } else {
        unset($data['password']);
    }

    $personne->update($data);
    return redirect()->route('profile.show');
}

public function search(Request $request)
{
    $query = $request->input('search');
    $oeuvres = Oeuvre::where('titre', 'LIKE', "%{$query}%")
                    ->orWhere('auteur', 'LIKE', "%{$query}%")
                    ->orWhere('genre', 'LIKE', "%{$query}%")
                    ->get();
    
    $genres = Oeuvre::select('genre')->distinct()->get();

    return view('index', compact('oeuvres', 'genres'));
}
    
public function searchp(Request $request)
{
    $query = $request->input('search');
    $user = Auth::user();

    // Search within purchased books
    $achats = Achat::where('id_pers', $user->id_pers)
                    ->whereHas('oeuvre', function ($queryBuilder) use ($query) {
                        $queryBuilder->where('titre', 'LIKE', "%{$query}%")
                                     ->orWhere('auteur', 'LIKE', "%{$query}%")
                                     ->orWhere('genre', 'LIKE', "%{$query}%");
                    })
                    ->with('oeuvre')
                    ->get();
    
    // If user is a member, also search within reservations
    if ($user->membre) {
        $reservations = Reservation::where('id_pers', $user->id_pers)
                                    ->whereHas('oeuvre', function ($queryBuilder) use ($query) {
                                        $queryBuilder->where('titre', 'LIKE', "%{$query}%")
                                                     ->orWhere('auteur', 'LIKE', "%{$query}%")
                                                     ->orWhere('genre', 'LIKE', "%{$query}%");
                                    })
                                    ->with('oeuvre')
                                    ->get();
    } else {
        $reservations = collect(); // Empty collection if not a member
    }

    $genres = Oeuvre::select('genre')->distinct()->get();

    return view('profile', compact('achats', 'reservations', 'genres'));
}


    public function acheter($id_livre, Request $request)
    {
        $oeuvre = Oeuvre::findOrFail($id_livre);
        $personne = Auth::user();
        $membre = Membre::where('id_pers', $personne->id_pers)->first();
        
        $prixOriginal = $oeuvre->prix;
        $prixTTC = $prixOriginal;

        // Appliquer une remise de 15% si l'utilisateur est un membre
        if ($membre) {
            $remise = 0.15;
            $prixTTC = $prixOriginal - ($prixOriginal * $remise);
        }

        // Récupérer la quantité saisie dans le formulaire
        $qts_achete = $request->input('qts_achete');

        // Créer un nouvel achat avec la quantité spécifiée
        $achat = new Achat();
        $achat->id_pers = $personne->id_pers;
        $achat->id_livre = $oeuvre->id_livre;
        $achat->qts_achete = $qts_achete; // Utiliser la quantité saisie dans le formulaire
        $achat->prix_totale = $prixOriginal * $qts_achete; // Mettre à jour le prix total en fonction de la quantité
        $achat->prix_ttc = $prixTTC * $qts_achete; // Mettre à jour le prix TTC en fonction de la quantité
        $achat->date_achat = now();

        $achat->save();

        return redirect('/')->with('success', 'Achat effectué avec succès !');
    }
    /*
    public function filterByGenre(Request $request)
{
    $genre = $request->input('genre');
    $oeuvres = Oeuvre::where('genre', $genre)->get();
    $genres = Oeuvre::select('genre')->distinct()->get();

    return view('index', compact('oeuvres', 'genres'));
}*/




public function filterByGenre(Request $request)
{
    $genre = $request->input('genre');
    $oeuvres = Oeuvre::where('genre', $genre)->get();
    $html = '<div class="container">'; // Ouvrir une nouvelle ligne de grille
    $html = '<div class="row">'; // Ouvrir une nouvelle ligne de grille

    foreach ($oeuvres as $oeuvre) {
        $html .= '<div class="col-md-3 card cc">'; // Définir la colonne avec la classe col-md-4
        $html .= '<div class="card-image">';
        $html .= '<img src="' . asset('storage/' . $oeuvre->image) . '" alt="' . $oeuvre->titre . '" style="max-height: 100px">';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h4 class="card-text"><span style="color: brown">Titre: ' . $oeuvre->titre . '</span></h4>';
        $html .= '<h4 class="card-text"><span style="color: brown">Auteur: ' . $oeuvre->auteur . '</span></h4>';
        $html .= '<h4 class="card-text"><span style="color: brown">Prix: ' . $oeuvre->prix . ' Dhs</span></h4>';
        $html .= '<a class="btn btn" style="background-color: rgb(143, 72, 15)" href="' . route('hshow', ['id_livre' => $oeuvre->id_livre]) . '">Details</a>';
        $html .= '</div></div>';
    }

    $html .= '</div>'; // Fermer la ligne de grille
    $html .= '</div>';
    return response()->json($html);
}

    public function creat($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);
        return view('achat', compact('oeuvre'));
    }
    
    public function reserve($id_oeuvre, Request $request)
    {
        $oeuvre = Oeuvre::findOrFail($id_oeuvre);
        $personne = Auth::user();

        // Créer une nouvelle réservation
        $reservation = new Reservation();
        $reservation->id_pers = $personne->id_pers;
        $reservation->id_oeuvre = $oeuvre->id_livre;
        $reservation->date_d_emprunt = $request->input('date_d_emprunt');
        $reservation->duree_d_emprunt = $request->input('duree_d_emprunt');
        
        $reservation->save();

        return redirect('/')->with('success', 'Réservation effectuée avec succès !');
    }
}
