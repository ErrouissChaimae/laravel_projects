<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Oeuvre;

class OeuvreController extends Controller
{
    public function index()
    {
        $oeuvres = Oeuvre::all();
        return view('admin.oeuvres.index', compact('oeuvres'));
    }

    public function create()
    {
        return view('admin.oeuvres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'date_parution' => 'required|date',
            'resumer' => 'required|string',
            'prix' => 'required|numeric',
            'quantite_stock' => 'required|integer',
            'stocke_emprunt' => 'required|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        Oeuvre::create($data);

        return redirect()->route('oeuvres.index');
    }

    public function show($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);
        return view('admin.oeuvres.show', compact('oeuvre'));
    }

    public function edit($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);
        return view('admin.oeuvres.edit', compact('oeuvre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'date_parution' => 'required|date',
            'resumer' => 'required|string',
            'prix' => 'required|numeric',
            'quantite_stock' => 'required|integer',
            'stocke_emprunt' => 'required|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $oeuvre = Oeuvre::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($oeuvre->image) {
                Storage::disk('public')->delete($oeuvre->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $oeuvre->update($data);

        return redirect()->route('oeuvres.index');
    }

    public function destroy($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);

        if ($oeuvre->image) {
            Storage::disk('public')->delete($oeuvre->image);
        }

        $oeuvre->delete();

        return redirect()->route('oeuvres.index');
    }
    public function search(Request $request)
    {
        $query = $request->input('search');
        $oeuvres = Oeuvre::where('titre', 'LIKE', "%{$query}%")
                            ->orWhere('auteur', 'LIKE', "%{$query}%")
                            ->orWhere('genre', 'LIKE', "%{$query}%")
                            ->orWhere('prix', 'LIKE', "%{$query}%")
                            ->get();
    
        return view('admin.oeuvres.index', compact('oeuvres'));
    }
}
