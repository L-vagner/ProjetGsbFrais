<?php

namespace App\dao;

use App\Models\Frais;
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

}
