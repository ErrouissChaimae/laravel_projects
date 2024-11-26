<?php

namespace App\Http\Controllers;

use App\Models\Autocar;
use Illuminate\Http\Request;

class AutocarController extends Controller
{

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $validatedData['query'];

        $autocars = Autocar::where('nom', 'like', '%' . $query . '%')
            ->get();

        return view('autocars.index', compact('autocars'));
    }

    public function index()
    {
        $autocars = Autocar::all();
        return view('autocars.index', compact('autocars'));
    }

    public function create()
    {
        return view('autocars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:autocars',
            'nombre_de_places' => 'required|integer',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('images'), $imageName);
        }
        Autocar::create([
            'photo' => $imageName ?? null,
            'nom' => $request->nom,
            'nombre_de_places' => $request->nombre_de_places,
            'date_arrivee' => $request->date_arrivee,

        ]);




        return redirect()->route('autocars.index')->with('success', 'Autocar créé avec succès.');
    }



    public function edit($id_autocar)
    {
        $autocar = Autocar::findOrFail($id_autocar);
        return view('autocars.edit', compact('autocar'));
    }

    public function update(Request $request, $id_autocar)
    {
        $request->validate([
            'nom' => 'required|unique:autocars,nom,' . $id_autocar . ',id_autocar',
            'nombre_de_places' => 'required|integer',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $autocar = Autocar::findOrFail($id_autocar);

        $data = [
            'nom' => $request->nom,
            'nombre_de_places' => $request->nombre_de_places,
            'photo' => $request->photo,

        ];

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $data['photo'] = $imageName;

            if ($autocar->photo && file_exists(public_path('images/' . $autocar->photo))) {
                unlink(public_path('images/' . $autocar->photo));
            }
        }

        $autocar->update($data);

        return redirect()->route('autocars.index')->with('success', 'Autocar mis à jour avec succès.');
    }


    public function destroy($id_autocar)
    {
        $autocar = Autocar::findOrFail($id_autocar);
        $autocar->delete();

        return redirect()->route('autocars.index')->with('success', 'Autocar supprimé avec succès.');
    }
}
