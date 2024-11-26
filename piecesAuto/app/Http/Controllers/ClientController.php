<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'required',
            'adresse' => 'required',
            'password' => 'required', 
                ]);
    
        try {
            $client = new Client();
            $client->nom = $request->input('nom');
            $client->prenom = $request->input('prenom');
            $client->email = $request->input('email');
            $client->telephone = $request->input('telephone');
            $client->adresse = $request->input('adresse');
            $client->password = $request->input('password');
            $client->save(); 
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'adresse' => 'required',
            'password' => 'required',
        ]);

        try {
            $client = Client::findOrFail($id);
            $client->update($request->all());
            return response()->json(['success' => true, 'message' => 'Client updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return redirect('/clients')->with('success', 'Client deleted!');
        } catch (\Exception $e) {
            return redirect('/clients')->with('error', 'Failed to delete client!');
        }
    }

    public function rechercher(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::where('nom', 'like', '%' . $search . '%')
                        ->orWhere('prenom', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('telephone', 'like', '%' . $search . '%')                    
                        ->orWhere('id_client', 'like', '%' . $search . '%')
                        ->get();
        return view('clients.index', compact('clients'));
    }
}
