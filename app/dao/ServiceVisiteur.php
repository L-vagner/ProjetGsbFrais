<?php

namespace App\dao;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;
use App\Models\Visiteur;

class ServiceVisiteur
{
    public function login($login, $pwd)
    {
        $connected = false;
        try {
            $visiteur = DB::table('visiteur')
                ->select()
                ->where('login_visiteur', '=', $login)
                ->first();
            if ($visiteur) {
                if ($visiteur->pwd_visiteur == $pwd) {
                    Session::put('id', $visiteur->id_visiteur);
                    Session::put('type', $visiteur->type_visiteur);
                    Session::put('login', $login);
                    $connected = true;
                }
            }

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
        return $connected;
    }

    public static function getLogin()
    {
        $login = "";
        if ((Session::has('id')) && (Session::get('id') > 0)) {
            $id = Session::get('id');
            try {
                $request = DB::table('visiteur')
                    ->select('login_visiteur')
                    ->where('id_visiteur', '=', $id)
                    ->first();
                if ($request) {
                    $login = $request->login_visiteur;
                }
            } catch (QueryException $e) {
                throw new MonException($e->getMessage(), 5);
            }
        }
        return $login;
    }

    public function logout()
    {
        Session::put('id', 0);
    }

    public function getVisiteurs()
    {
        try {
            $mesVisiteurs = Visiteur::all();
            return $mesVisiteurs;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
