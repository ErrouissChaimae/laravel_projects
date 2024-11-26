<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $mdp = $request->input('mdp');
    
        $admin = DB::table('admins')->where('email', $email)->first();
    
        if ($admin) {
            if (Hash::check($mdp, $admin->mdp)) {
                return redirect()->route('clients.index');
            } else {
                return redirect()->route('login.login')->with('error', 'Mot de passe incorrect.');
            }
        } else {
            return redirect()->route('login.login')->with('error', 'Email non trouvé.');
        }
    }
    
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login.login'); 
    }
   
}
