<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* --- LOGIN --- */

    // Affiche le formulaire de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Gère la tentative de connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirection : Admin vers Dashboard, User vers Accueil
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.index');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ]);
    }

    /* --- REGISTER --- */

    // Affiche le formulaire d'inscription
    public function showRegister()
    {
        return view('auth.register');
    }

    // Gère la création du compte
    public function register(Request $request)
    {
        // 1. Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hachage sécurisé
            'is_admin' => false, // Par défaut un utilisateur normal
        ]);

        // 3. Connexion automatique après inscription
        Auth::login($user);

        return redirect('/')->with('success', 'Bienvenue ! Votre compte a été créé avec succès.');
    }

    /* --- LOGOUT --- */

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}