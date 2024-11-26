<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personne;
use App\Models\Membre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonneAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('personne.login');
    }

    public function showRegisterForm()
    {
        return view('personne.register');
    }

    public function register(Request $request)
{
    $validatedData = $request->validate([
        'cin' => 'required|unique:personnes',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:personnes',
        'tel' => 'required|string|max:15',
        'adresse' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $personne = Personne::create([
        'cin' => $validatedData['cin'],
        'nom' => $validatedData['nom'],
        'prenom' => $validatedData['prenom'],
        'email' => $validatedData['email'],
        'tel' => $validatedData['tel'],
        'adresse' => $validatedData['adresse'],
        'password' => Hash::make($validatedData['password']),
    ]);

    Auth::guard('web')->login($personne);

    return redirect()->route('top-ventes');
}


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $personne = Personne::where('email', $credentials['email'])->first();
        
        if ($personne && Hash::check($credentials['password'], $personne->password)) {
            Auth::guard('web')->login($personne);
        
            $membre = Membre::where('id_pers', $personne->id_pers)->first();
        
            if ($membre) {
                return redirect()->route('top-ventes');
            } else {
                return redirect()->route('top-ventes');
            }
        }
        
        return back()->withErrors([
            'email' => 'Les informations d’identification ne correspondent pas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    // PersonneAuthController.php






}
