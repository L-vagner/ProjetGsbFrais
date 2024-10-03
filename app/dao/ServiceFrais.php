<?php

namespace App\dao;

use App\Models\Frais;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceFrais
{
    public function getFrais($id)
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

    public function getById($id_frais)
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

    public function updateFrais($id_frais, $anneemois, $nbjustificatifs)
    {
        try {
            $aujourdhui = date("Y-m-d");
            DB::table('frais')

                ->where('id_frais', '=', $id_frais)
                ->update(['datemodification'=>$aujourdhui,
                    'anneemois'=>$anneemois,
                    'nbjustificatifs'=>$nbjustificatifs]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
