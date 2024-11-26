<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $cs = $request->only('login', 'password');

        if (Auth::guard('admin')->attempt($cs)) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'login' => 'Les informations d’identification ne correspondent pas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
