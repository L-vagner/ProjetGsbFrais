<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceVisiteur;
use Exception;

class VisiteurControlleur extends Controller
{
    public function getLogin()
    {
        $erreur = "";
        try {
            return view('vues/formLogin', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function signIn(Request $request)
    {
        $erreur = "";
        try {
            $login = $request->input('login');
            $pwd = $request->input('pwd');
            $serviceVisiteur = new ServiceVisiteur();
            $connected = $serviceVisiteur->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') == 'P') {
                    return view('vues/homePraticien');
                } else {
                    return view('home', compact('login'));
                }
            } else {
                $erreur = "Login ou mot de passe inconnu";
                return view('vues/formLogin', compact('erreur'));
            }
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function signOut()
    {
        $serviceVisiteur = new ServiceVisiteur();
        $serviceVisiteur->logout();
        return view('home');
    }
}
