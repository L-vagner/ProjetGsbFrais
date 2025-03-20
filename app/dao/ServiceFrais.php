<?php

namespace App\dao;

use App\Models\Frais;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceFrais
{
    public function getFrais($id) //renvois les frais associées a un visiteur en utilisant l'id du visiteur
    {
        try {
            $lesFrais = DB::table('frais')
                ->select()
                ->where('id_visiteur', '=', $id)
                ->get();
            return $lesFrais;

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getById($id_frais) //renvoie les informations d'un frais en utilisant son ID
    {
        try {
            $frais = DB::table('frais')
                ->select()
                ->where('id_frais', '=', $id_frais)
                ->first();
            return $frais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateFrais($id_frais, $anneemois, $nbjustificatifs) //met a jour / modifie un frais
    {
        try {
            $aujourdhui = date("Y-m-d");
            DB::table('frais')
                ->where('id_frais', '=', $id_frais)
                ->update(['datemodification' => $aujourdhui,
                    'anneemois' => $anneemois,
                    'nbjustificatifs' => $nbjustificatifs]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function insertFrais($id_visiteur, $anneemois, $nbjustificatifs) // ajoute un frais a un visiteur
    {
        try {
            $aujourdhui = date("Y-m-d");
            DB::table('frais')
                ->insert(
                    ['datemodification' => $aujourdhui,
                        'id_etat' => 2,
                        'id_visiteur' => $id_visiteur,
                        'anneemois' => $anneemois,
                        'nbjustificatifs' => $nbjustificatifs]
                );
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteFrais($id_frais) // supprime le frais
    {
        try {
            DB::table('frais')->where('id_frais', '=', $id_frais)->delete();
        } catch (QueryException $e) {
            $erreur = $e->getMessage();
            if ($e->getCode() == "23000") {
                $erreur = "Impossible de supprimer une fiche ayant des frais liés";
            }
            throw new MonException($erreur, 5);
        }
    }

    public function deleteFraisFull($id_frais) // supprime le frais et le frais hors forfait liés
    {
        try {
            DB::table('fraishorsforfait')->where('id_frais', '=', $id_frais)->delete();
            DB::table('frais')->where('id_frais', '=', $id_frais)->delete();
        } catch (QueryException $e) {
            $erreur = $e->getMessage();
            throw new MonException($erreur, 5);
        }
    }

    public function confirmFraisHF($id_frais, $montant)
    {
        try {
            DB::table('frais')
                ->where('id_frais', '=', $id_frais)
                ->update(['montantvalide' => $montant]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
