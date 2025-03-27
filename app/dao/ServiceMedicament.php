<?php

namespace App\dao;

use App\Models\Composant;
use App\Models\Medicament;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceMedicament
{
    public function getMedicaments()
    {
        try {
            $medicaments = Medicament::all(['id_medicament', 'nom_commercial']);
            return $medicaments;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }

    }

    public function getMedicamentById($id)
    {
        try {
            $medicament = Medicament::where('id_medicament', $id)->first();
            return $medicament;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}

