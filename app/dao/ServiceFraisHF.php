<?php

namespace App\dao;

use App\Models\FraisHF;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceFraisHF
{
    public function getFraisHF($id_frais) //Utilise l'id d'une liste de frais pour trouver et renvoyer tout les frais hors forfait et la somme total des montants
    {
        try {
            $mesFraisHF = DB::table('fraishorsforfait')
                ->select('date_fraishorsforfait', 'lib_fraishorsforfait', 'montant_fraishorsforfait', 'id_frais', 'id_fraishorsforfait')
                ->where('id_frais', '=', $id_frais)
                ->orderBy('date_fraishorsforfait')
                ->get();

            return $mesFraisHF;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getMontantFraisHF($id_frais)
    {
        try {
            $sommeFrais = DB::table('fraishorsforfait')
                ->where('id_frais', '=', $id_frais)
                ->sum('montant_fraishorsforfait');
            return $sommeFrais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }

    }

    public function getById($id_fraisHF)
    {
        try {
            $unFrais = DB::table('fraishorsforfait')
                ->select('*')
                ->where('id_fraishorsforfait', '=', $id_fraisHF)
                ->first();
            return $unFrais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateFraisHF($id_fraisHF, $date_fraisHF, $lib_fraisHF, $montant_fraisHF)
    {
        try {
            DB::table('fraishorsforfait')
                ->where('id_fraishorsforfait', '=', $id_fraisHF)
                ->update(['date_fraishorsforfait' => $date_fraisHF,
                    'lib_fraishorsforfait' => $lib_fraisHF,
                    'montant_fraishorsforfait' => $montant_fraisHF]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function insertFraisHF($id_frais, $date_fraisHF, $lib_fraisHF, $montant_fraisHF)
    {
        try {
            DB::table('fraishorsforfait')
                ->insert(['id_frais' => $id_frais,
                    'date_fraishorsforfait' => $date_fraisHF,
                    'lib_fraishorsforfait' => $lib_fraisHF,
                    'montant_fraishorsforfait' => $montant_fraisHF,]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getIdFrais($id_fraisHF)
    {
        try {
            $id_frais = DB::table('fraishorsforfait')
                ->select('id_frais')
                ->where('id_fraishorsforfait', '=', $id_fraisHF)
                ->first();
            return $id_frais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteFraisHF($id_fraisHF)
    {
        try {
            DB::table('fraishorsforfait')
                ->where('id_fraishorsforfait', '=', $id_fraisHF)
                ->delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
