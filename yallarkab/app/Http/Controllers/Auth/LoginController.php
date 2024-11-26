<?php
// App\Http\Controllers\Auth\LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showClientLoginForm()
    {
        return view('auth.login-client');
    }

    public function clientLogin(Request $request)
    {
        $this->validateLogin($request);

        if ($request->ajax()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'client'])) {
                return response()->json(['success' => true, 'redirect' => url('/')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Les informations d\'identification ne correspondent pas à nos enregistrements!']);
            }
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'client'])) {
                return redirect()->intended('/home');
            }

            return back()->withErrors([
                'email' => 'Les informations d\'identification ne correspondent pas à nos enregistrements!',
            ]);
        }
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    }


    public function showAdminLoginForm()
    {
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function loggedOut(Request $request)
    {
        return redirect('/');
    }
}
