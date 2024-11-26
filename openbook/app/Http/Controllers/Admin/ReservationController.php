<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use App\Models\Oeuvre;
use App\Models\Emprunt;
use App\Models\Personne;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB; // Ajoutez cette ligne
use DateTime;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['membre.personne', 'oeuvre'])->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $membres = Membre::all();
        $oeuvres = Oeuvre::all();
        return view('admin.reservations.create', compact('membres', 'oeuvres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pers' => 'required|exists:membres,id_pers',
            'id_oeuvre' => 'required|exists:oeuvres,id_livre',
            'date_d_emprunt' => 'required|date',
            'duree_d_emprunt' => 'required|integer|min:1',
        ]);
    
        $date_debut = $request->date_d_emprunt;
        $date_fin = (new DateTime($date_debut))->modify("+{$request->duree_d_emprunt} days")->format('Y-m-d');
    
        // Vérification des réservations existantes pour l'œuvre sur la période
        $existingReservations = Reservation::where('id_oeuvre', $request->id_oeuvre)
            ->where(function ($query) use ($date_debut, $date_fin) {
                $query->whereBetween('date_d_emprunt', [$date_debut, $date_fin])
                      ->orWhereBetween(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), [$date_debut, $date_fin])
                      ->orWhere(function ($query) use ($date_debut, $date_fin) {
                          $query->where('date_d_emprunt', '<=', $date_debut)
                                ->where(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), '>=', $date_fin);
                      });
            })->count();
    
        // Vérification des emprunts existants pour l'œuvre sur la période, en tenant compte du rendu
        $existingEmprunts = Emprunt::where('id_livre', $request->id_oeuvre)
            ->where('rendu', 'non')
            ->where(function ($query) use ($date_debut, $date_fin) {
                $query->whereBetween('date_debut', [$date_debut, $date_fin])
                      ->orWhereBetween('date_fin', [$date_debut, $date_fin])
                      ->orWhere(function ($query) use ($date_debut, $date_fin) {
                          $query->where('date_debut', '<=', $date_debut)
                                ->where('date_fin', '>=', $date_fin);
                      });
            })->count();
    
        // Vérification de la disponibilité dans le stock_emprunt
        $oeuvre = Oeuvre::findOrFail($request->id_oeuvre);
    
        if (($existingReservations + $existingEmprunts) >= $oeuvre->stocke_emprunt) {
            return redirect()->route('reservations.create')
                ->withErrors(['Pas de stock disponible pour cette œuvre à la période sélectionnée.'])
                ->withInput();
        }
    
        Reservation::create($request->all());
    
        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
    }
    
    

public function search(Request $request)
{
    $search = $request->input('search');

    $reservations = Reservation::with(['membre.personne', 'oeuvre'])
                    ->whereHas('membre.personne', function ($query) use ($search) {
                        $query->where('nom', 'like', "%$search%")
                              ->orWhere('prenom', 'like', "%$search%");
                    })
                    ->orWhereHas('oeuvre', function ($query) use ($search) {
                        $query->where('titre', 'like', "%$search%");
                    })->get();

    return view('admin.reservations.index', compact('reservations'));
}

    

    public function show($id)
    {
        $reservation = Reservation::with(['membre', 'oeuvre'])->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::with(['membre', 'oeuvre'])->findOrFail($id);
        $membres = Membre::all();
        $oeuvres = Oeuvre::all();
        return view('admin.reservations.edit', compact('reservation', 'membres', 'oeuvres'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'id_pers' => 'required|exists:membres,id_pers',
        'id_oeuvre' => 'required|exists:oeuvres,id_livre',
        'date_d_emprunt' => 'required|date',
        'duree_d_emprunt' => 'required|integer|min:1',
    ]);

    $date_debut = $request->date_d_emprunt;
    $date_fin = (new DateTime($date_debut))->modify("+{$request->duree_d_emprunt} days")->format('Y-m-d');

    // Vérification des réservations existantes pour l'œuvre sur la période (à l'exception de la réservation actuelle)
    $existingReservations = Reservation::where('id_oeuvre', $request->id_oeuvre)
        ->where('id_res', '!=', $id)
        ->where(function ($query) use ($date_debut, $date_fin) {
            $query->whereBetween('date_d_emprunt', [$date_debut, $date_fin])
                  ->orWhereBetween(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), [$date_debut, $date_fin])
                  ->orWhere(function ($query) use ($date_debut, $date_fin) {
                      $query->where('date_d_emprunt', '<=', $date_debut)
                            ->where(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), '>=', $date_fin);
                  });
        })->count();

    // Vérification des emprunts existants pour l'œuvre sur la période, en tenant compte du rendu
    $existingEmprunts = Emprunt::where('id_livre', $request->id_oeuvre)
        ->where('rendu', 'non')
        ->where(function ($query) use ($date_debut, $date_fin) {
            $query->whereBetween('date_debut', [$date_debut, $date_fin])
                  ->orWhereBetween('date_fin', [$date_debut, $date_fin])
                  ->orWhere(function ($query) use ($date_debut, $date_fin) {
                      $query->where('date_debut', '<=', $date_debut)
                            ->where('date_fin', '>=', $date_fin);
                  });
        })->count();

    // Vérification de la disponibilité dans le stock_emprunt
    $oeuvre = Oeuvre::findOrFail($request->id_oeuvre);

    if (($existingReservations + $existingEmprunts) >= $oeuvre->stocke_emprunt) {
        return redirect()->route('reservations.edit', $id)
            ->withErrors(['Pas de stock disponible pour cette œuvre à la période sélectionnée.'])
            ->withInput();
    }

    $reservation = Reservation::findOrFail($id);
    $reservation->update($request->all());

    return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
}

    

    
    

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }
}
