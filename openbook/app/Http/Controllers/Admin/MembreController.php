<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Import Carbon for date handling

class MembreController extends Controller
{
    public function index(Request $request)
{
    $query = $request->get('query');
    $membres = Membre::with('personne')
                    ->whereHas('personne', function ($queryBuilder) use ($query) {
                        $queryBuilder->where('nom', 'like', "%{$query}%")
                                    ->orWhere('prenom', 'like', "%{$query}%")
                                    ->orWhere('email', 'like', "%{$query}%")
                                    ->orWhere('tel', 'like', "%{$query}%");
                    })
                    ->get();

    return view('admin.membres.index', compact('membres'));
}


    public function create()
    {
        $personnes = Personne::all();
        $currentDate = Carbon::now()->toDateString();
        return view('admin.membres.create', compact('personnes', 'currentDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pers' => 'required|exists:personnes,id_pers',
            'mois_payer' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['date_inscription'] = Carbon::now()->toDateString();

        Log::info('Store Membre Request Data:', $data);

        Membre::create($data);
        return redirect()->route('membres.index');
    }

    public function show($id)
    {
        $membre = Membre::with('personne')->findOrFail($id);
        return view('admin.membres.show', compact('membre'));
    }

    public function edit($id)
    {
        $membre = Membre::findOrFail($id);
        $personnes = Personne::all();
        $currentDate = Carbon::now()->toDateString();
        return view('admin.membres.edit', compact('membre', 'personnes', 'currentDate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pers' => 'required|exists:personnes,id_pers',
            'mois_payer' => 'required|boolean',
        ]);

        Log::info('Update Membre Request Data:', $request->all());

        $membre = Membre::findOrFail($id);
        $membre->update($request->all());
        return redirect()->route('membres.index');
    }

    public function destroy($id)
    {
        Membre::findOrFail($id)->delete();
        return redirect()->route('membres.index');
    }


}
