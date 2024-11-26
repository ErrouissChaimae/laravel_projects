<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginClient');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        $client = DB::table('clients')->where('email', $email)->first();
    
        if ($client) {
            if ($password === $client->password) {
                $request->session()->put('user_email', $client->email);
                $request->session()->put('user_id', $client->id_client); 
                return redirect()->route('articlesliste.index');
            } else {
                return redirect()->route('login')->with('error', 'Mot de passe incorrect.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email non trouvé.');
        }
    }
    

}
