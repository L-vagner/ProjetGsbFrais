<?php

namespace App\dao;

use App\Models\Composant;
use App\Models\Famille;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceFamille
{
    public function getFamilles()
    {
        try {
            $familles = Famille::all();
            return $familles;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
