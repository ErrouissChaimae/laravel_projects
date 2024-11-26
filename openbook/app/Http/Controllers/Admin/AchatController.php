<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\Membre;
use App\Models\Oeuvre;
use App\Models\Personne;

use Illuminate\Http\Request;

class AchatController extends Controller
{
    
        public function index(Request $request)
    {
        $search = $request->input('search');
$personnes=Personne::all();
        $achats = Achat::with(['personne', 'oeuvre'])
                        ->whereHas('personne', function ($personneQuery) use ($search) {
                            $personneQuery->where('nom', 'like', "%$search%")
                                          ->orWhere('prenom', 'like', "%$search%");
                        })
                        ->orWhereHas('oeuvre', function ($oeuvreQuery) use ($search) {
                            $oeuvreQuery->where('titre', 'like', "%$search%");
                        })
                        ->paginate(10);

        return view('admin.achats.index', compact('achats','personnes'));
    }
    

    public function create()
    {
        $oeuvres = Oeuvre::all();
        $personnes=Personne::all();

        return view('admin.achats.create', compact('personnes', 'oeuvres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pers' => 'required|exists:membres,id_pers',
            'id_livre' => 'required|exists:oeuvres,id_livre',
            'qts_achete' => 'required|integer|min:1',
            'livrer' => 'required|in:oui,non',
        ]);

        Achat::create($request->all());
        return redirect()->route('achats.index')->with('success', 'Achat ajouté avec succès.');
    }

    public function show($id)
    {
        $achat = Achat::findOrFail($id);
        return view('admin.achats.show', compact('achat'));
    }

    public function edit($id)
    {
        $achat = Achat::findOrFail($id);
        $personnes = Membre::all();
        $oeuvres = Oeuvre::all();
        return view('admin.achats.edit', compact('achat', 'personnes', 'oeuvres'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pers' => 'required|exists:membres,id_pers',
            'id_livre' => 'required|exists:oeuvres,id_livre',
            'qts_achete' => 'required|integer|min:1',
            'livrer' => 'required|in:oui,non',
        ]);

        $achat = Achat::findOrFail($id);
        $achat->update($request->all());
        return redirect()->route('achats.index')->with('success', 'Achat mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Achat::findOrFail($id)->delete();
        return redirect()->route('achats.index')->with('success', 'Achat supprimé avec succès.');
    }
}
