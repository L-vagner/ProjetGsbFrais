<?php

namespace App\dao;

use App\Models\Praticien;
use App\Models\Rapport;
use App\Models\Medicament;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceRapport
{
    public function getRapports(): Collection
    {
        try {
            $rapports = Rapport::all();
            return $rapports;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getRapport($id): Rapport
    {
        try {
            $rapport = Rapport::where('id_rapport', $id)->with(
                [
                    'praticien' => function ($q) use ($id) {
                        $q->select('id_praticien', 'nom_praticien', 'prenom_praticien');
                    },
                    'visiteur' => function ($q) use ($id) {
                        $q->select('id_visiteur', 'nom_visiteur', 'prenom_visiteur');
                    }
                ])->get();
            return $rapport[0];
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getPraticiens(): Collection
    {
        try {
            $praticiens = Praticien::all();
            return $praticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getPraticien($id): Collection
    {
        try {
            $praticien = Praticien::where('id_praticien', $id)->get();
            return $praticien;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updateRapport($id_rap, $id_prat, $id_visit, $date, $bilan, $motif): void
    {

        try {
            $rapport = Rapport::firstWhere('id_rapport', $id_rap);
            $rapport->id_praticien = $id_prat;
            $rapport->id_visiteur = $id_visit;
            $rapport->date_rapport = $date;
            $rapport->bilan = $bilan;
            $rapport->motif = $motif;
            $rapport->save();

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function insertRapport($id_prat, $id_visit, $date, $bilan, $motif): void
    {
        try {
            $rapport = new Rapport();
            $rapport->id_praticien = $id_prat;
            $rapport->id_visiteur = $id_visit;
            $rapport->date_rapport = $date;
            $rapport->bilan = $bilan;
            $rapport->motif = $motif;
            $rapport->save();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function addMedocOffert(int $id_rapport)
    {


    }

    public function validateMedocOffert(Request $request)
    {

    }

    public function removeMedocOffert(int $id_rapport, int $id_medoc): void
    {

    }

}
