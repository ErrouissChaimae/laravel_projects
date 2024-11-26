<?php
// App\Http\Controllers\Auth\RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function showClientRegistrationForm()
    {
        return view('auth.register-client');
    }

    public function registerClient(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->createClient($request->all());
        $this->guard()->login($user);
        return redirect($this->redirectPath());
    }

    public function showAdminRegistrationForm()
    {
        return view('auth.register-admin');
    }

    public function registerAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->createAdmin($request->all());
        $this->guard()->login($user);
        return redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tel' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'cin' => ['nullable', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function createClient(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_CLIENT,
            'tel' => $data['tel'],
            'address' => $data['address'],
            'cin' => $data['cin'],
            'prenom' => $data['prenom'],
        ]);
    }

    protected function createAdmin(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_ADMIN,
            'tel' => $data['tel'],
            'address' => $data['address'],
            'cin' => $data['cin'],
            'prenom' => $data['prenom'],

        ]);
        

    }
    

protected function redirectPath()
{
    return auth()->user()->isAdmin() ? '/dashboard' : '/home';
}

}
