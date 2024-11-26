<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller

{
    public function search(Request $request)
{
    $validatedData = $request->validate([
        'query' => 'required|string|max:255',
    ]);

    $query = $validatedData['query'];

    $users = User::where('role', 'client')
                 ->where(function($q) use ($query) {
                     $q->where('name', 'like', '%' . $query . '%')
                       ->orWhere('cin', 'like', '%' . $query . '%');
                 })
                 ->get();

    return view('admin.dashboard', compact('users'));
}

    public function index()
    {
        $users = User::where('role', 'client')->get();

        return view('admin.dashboard', compact('users'));
    }



   public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'tel' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:50',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $validatedData['name'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'tel' => $validatedData['tel'],
            'address' => $validatedData['address'],
            'cin' => $validatedData['cin'],
        ]);

        return redirect('/dashboard')->with('success', 'Utilisateur Moddifier avec succès');
    }

    public function destroy($id)
    {
         User::destroy($id);

        return redirect('/dashboard')->with('success', 'Utilisateur supprimé avec succès');
    }
}
