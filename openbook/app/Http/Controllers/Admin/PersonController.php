<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PersonController extends Controller
{
    public function index()
    {
        $personnes = Personne::all();
        return view('admin.personnes.index', compact('personnes'));
    }

    public function create()
    {
        return view('admin.personnes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cin' => 'required|unique:personnes',
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:personnes',
            'tel' => 'required',
            'password' => 'required|min:8',
            'adresse' => 'required',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Personne::create($data);
        return redirect()->route('personnes.index');
    }

    public function edit($id)
    {
        $personne = Personne::findOrFail($id);
        return view('admin.personnes.edit', compact('personne'));
    }
    public function show($id)
    {
        $personne = Personne::findOrFail($id);
        return view('admin.personnes.show', compact('personne'));
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
        return redirect()->route('personnes.index');
    }

    public function destroy($id)
    {
        $personne = Personne::findOrFail($id);
        $personne->delete();
        return redirect()->route('personnes.index');
    }

    
    public function search(Request $request)
    {
        $query = $request->input('search');
        $personnes = Personne::where('nom', 'LIKE', "%{$query}%")
                            ->orWhere('prenom', 'LIKE', "%{$query}%")
                            ->orWhere('cin', 'LIKE', "%{$query}%")
                            ->orWhere('email', 'LIKE', "%{$query}%")
                            ->orWhere('tel', 'LIKE', "%{$query}%")
                            ->get();
    
        return view('admin.personnes.index', compact('personnes'));
    }
    
    

}
