<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }
    

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cin' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update($validatedData);

        return redirect('/')->with('success', 'Profil mis à jour avec succès');
    }

        
    }
    