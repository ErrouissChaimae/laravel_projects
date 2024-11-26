<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emprunt;
use App\Models\Membre;
use App\Models\Reservation;
use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmpruntController extends Controller
{
    public function index()
    {
        $emprunts = Emprunt::with(['membre', 'oeuvre'])->get();
        return view('admin.emprunts.index', compact('emprunts'));
    }

    public function create()
    {
        $membres = Membre::all();
        $oeuvres = Oeuvre::all();
        return view('admin.emprunts.create', compact('membres', 'oeuvres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_membre' => 'required|exists:membres,id_m',
            'id_livre' => 'required|exists:oeuvres,id_livre',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'rendu' => 'required|in:oui,non',
        ]);
    
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
    
        // Vérification des réservations existantes pour l'œuvre sur la période
        $existingReservations = Reservation::where('id_oeuvre', $request->id_livre)
            ->where(function ($query) use ($date_debut, $date_fin) {
                $query->whereBetween('date_d_emprunt', [$date_debut, $date_fin])
                      ->orWhereBetween(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), [$date_debut, $date_fin])
                      ->orWhere(function ($query) use ($date_debut, $date_fin) {
                          $query->where('date_d_emprunt', '<=', $date_debut)
                                ->where(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), '>=', $date_fin);
                      });
            })->count();
    
        // Vérification des emprunts existants pour l'œuvre sur la période, en tenant compte du rendu
        $existingEmprunts = Emprunt::where('id_livre', $request->id_livre)
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
        $oeuvre = Oeuvre::findOrFail($request->id_livre);
    
        if (($existingReservations + $existingEmprunts) >= $oeuvre->stocke_emprunt) {
            return redirect()->route('emprunts.create')
                ->withErrors(['Pas de stock disponible pour cette œuvre à la période sélectionnée.'])
                ->withInput();
        }
    
        Emprunt::create($request->all());
    
        return redirect()->route('emprunts.index')->with('success', 'Emprunt ajouté avec succès.');
    }
    
    



    public function show($id)
    {
        $emprunt = Emprunt::findOrFail($id);
        return view('admin.emprunts.show', compact('emprunt'));
    }

    public function edit($id)
    {
        $emprunt = Emprunt::findOrFail($id);
        $membres = Membre::all();
        $oeuvres = Oeuvre::all();
        return view('admin.emprunts.edit', compact('emprunt', 'membres', 'oeuvres'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_membre' => 'required|exists:membres,id_m',
            'id_livre' => 'required|exists:oeuvres,id_livre',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'rendu' => 'required|in:oui,non',
        ]);
    
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
        $emprunt = Emprunt::findOrFail($id);
    
        // Vérification des réservations existantes pour l'œuvre sur la période
        $existingReservations = Reservation::where('id_oeuvre', $request->id_livre)
            ->where(function ($query) use ($date_debut, $date_fin) {
                $query->whereBetween('date_d_emprunt', [$date_debut, $date_fin])
                      ->orWhereBetween(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), [$date_debut, $date_fin])
                      ->orWhere(function ($query) use ($date_debut, $date_fin) {
                          $query->where('date_d_emprunt', '<=', $date_debut)
                                ->where(DB::raw('DATE_ADD(date_d_emprunt, INTERVAL duree_d_emprunt DAY)'), '>=', $date_fin);
                      });
            })->count();
    
        // Vérification des emprunts existants pour l'œuvre sur la période, en tenant compte du rendu
        $existingEmprunts = Emprunt::where('id_livre', $request->id_livre)
            ->where('rendu', 'non')
            ->where('id_emprunt', '!=', $id) // Utiliser le bon nom de colonne pour l'identifiant unique
            ->where(function ($query) use ($date_debut, $date_fin) {
                $query->whereBetween('date_debut', [$date_debut, $date_fin])
                      ->orWhereBetween('date_fin', [$date_debut, $date_fin])
                      ->orWhere(function ($query) use ($date_debut, $date_fin) {
                          $query->where('date_debut', '<=', $date_debut)
                                ->where('date_fin', '>=', $date_fin);
                      });
            })->count();
    
        // Vérification de la disponibilité dans le stock_emprunt
        $oeuvre = Oeuvre::findOrFail($request->id_livre);
    
        if (($existingReservations + $existingEmprunts) >= $oeuvre->stocke_emprunt) {
            return redirect()->route('emprunts.edit', $id)
                ->withErrors(['Pas de stock disponible pour cette œuvre à la période sélectionnée.'])
                ->withInput();
        }
    
        // Vérification supplémentaire pour éviter de changer le statut de rendu à non s'il y a un conflit
        if ($emprunt->rendu === 'oui' && $request->rendu === 'non') {
            $conflictingEmprunts = Emprunt::where('id_livre', $request->id_livre)
                ->where('id_emprunt', '!=', $id) // Utiliser le bon nom de colonne pour l'identifiant unique
                ->where('rendu', 'non')
                ->where(function ($query) use ($date_debut, $date_fin) {
                    $query->whereBetween('date_debut', [$date_debut, $date_fin])
                          ->orWhereBetween('date_fin', [$date_debut, $date_fin])
                          ->orWhere(function ($query) use ($date_debut, $date_fin) {
                              $query->where('date_debut', '<=', $date_debut)
                                    ->where('date_fin', '>=', $date_fin);
                          });
                })->count();
    
            if ($conflictingEmprunts > 0) {
                return redirect()->route('emprunts.edit', $id)
                    ->withErrors(['Impossible de changer le statut de rendu à non car il y a des conflits avec d\'autres emprunts ou réservations.'])
                    ->withInput();
            }
        }
    
        $emprunt->update($request->all());
        return redirect()->route('emprunts.index')->with('success', 'Emprunt mis à jour avec succès.');
    }
    
    
    public function search(Request $request)
    {
        // Récupérer les critères de recherche depuis la requête
        $searchTerm = $request->input('search');

        // Requête de recherche
        $emprunts = Emprunt::query()
            ->whereHas('membre', function ($query) use ($searchTerm) {
                $query->where('nom', 'like', "%{$searchTerm}%")
                      ->orWhere('prenom', 'like', "%{$searchTerm}%")
                      ->orWhere('email', 'like', "%{$searchTerm}%")
                      ->orWhere('cin', 'like', "%{$searchTerm}%");
                      ;
            }) ->orWhereHas('oeuvre', function ($query) use ($searchTerm) {
                $query->where('titre', 'like', "%{$searchTerm}%")
                ->orwhere('genre', 'like', "%{$searchTerm}%")
                ->where('auteur', 'like', "%{$searchTerm}%")

                ;
            })
            ->orWhereHas('oeuvre', function ($query) use ($searchTerm) {
                $query->where('titre', 'like', "%{$searchTerm}%")
                ->orwhere('genre', 'like', "%{$searchTerm}%")
                ->where('auteur', 'like', "%{$searchTerm}%")

                ;
            })
            ->get();

        // Retourner les résultats à la vue
        return view('admin.emprunts.index', compact('emprunts'));
    }


    public function destroy($id)
    {
        Emprunt::findOrFail($id)->delete();
        return redirect()->route('emprunts.index')->with('success', 'Emprunt supprimé avec succès.');
    }
}

