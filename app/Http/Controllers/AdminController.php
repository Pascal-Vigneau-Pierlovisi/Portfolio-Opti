<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('admin.login'); // Assurez-vous que vous avez créé cette vue
    }

    // Gérer la tentative de connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenter de connecter l'utilisateur
        if (Auth::guard('admin')->attempt($credentials)) {
            // Stocker le nom de l'admin dans la session
            $admin = Auth::guard('admin')->user();
            session(['admin_name' => $admin->name]);

            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard'); // Rediriger vers le tableau de bord de l'admin
        }

        // Si l'authentification échoue, renvoyer au formulaire de connexion avec une erreur
        return back();
    }

    // Gérer la déconnexion
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Rediriger vers la page d'accueil ou l'endroit que vous souhaitez après la déconnexion
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
