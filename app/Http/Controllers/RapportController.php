<?php

namespace App\Http\Controllers;


use App\dao\ServiceMedicament;
use App\dao\ServiceRapport;
use App\dao\ServiceVisiteur;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function afficheRapport()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceRapport = new ServiceRapport();
            $mesRapports = $serviceRapport->getRapports();
            return view('vues/listeRapport', compact('mesRapports', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function rechercheRapport()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceRapport = new ServiceRapport();
            $formOptions = $serviceRapport->getRapports();
            $title = "rapport de visite";
            $search = "rapport";
            return view('vues/formFind', compact('title', 'search', 'formOptions', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function addRapport()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $id_praticien = $_GET['id_prat'] ?? null;
        try {
            $serviceRapport = new ServiceRapport();
            $serviceVisiteur = new ServiceVisiteur();

            if (is_null($id_praticien)) {
                $id_praticien = 0;
            } else {
                $id_praticien = intval($id_praticien);
            }

            $mesPraticiens = $serviceRapport->getPraticiens();
            $mesVisiteurs = $serviceVisiteur->getVisiteurs();
            return view('vues/formEditRapport', compact('erreur',
                'id_praticien', 'mesPraticiens', 'mesVisiteurs'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function updateRapport(int $id_rapport)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceRapport = new ServiceRapport();
            $serviceVisiteur = new ServiceVisiteur();

            $monRapport = $serviceRapport->getRapport($id_rapport);
            $mesPraticiens = $serviceRapport->getPraticiens();
            $mesVisiteurs = $serviceVisiteur->getVisiteurs();
            return view('vues/formEditRapport', compact('erreur',
                'id_rapport', 'monRapport', 'mesPraticiens', 'mesVisiteurs'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validateRapport(Request $request)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $id_rapport = $request->input('id_rapport');
            $id_praticien = $request->input('id_praticien');
            $id_visiteur = $request->input('id_visiteur');
            $date = $request->input('date');
            $bilan = $request->input('bilan');
            $motif = $request->input('motif');

            $serviceRapport = new ServiceRapport();
            if ($id_rapport < 0) {
                $serviceRapport->insertRapport($id_praticien, $id_visiteur, $date, $bilan, $motif);
            } else {
                $serviceRapport->updateRapport($id_rapport, $id_praticien, $id_visiteur, $date, $bilan, $motif);
            }

            return redirect('/getRapport');

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function afficheMedocOffert(int $id_rapport)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceRapport = new ServiceRapport();
            $monRapport = $serviceRapport->getRapport($id_rapport);
            $mesMedocs = $this->getMedicamentsOffert($id_rapport);
            return view('vues/MedocOffert', compact('erreur',
                'mesMedocs', 'id_rapport', 'monRapport'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function addMedocOffert(int $id_rapport)
    {
        try {
            $mesMedocs = $this->getMedicamentsOffert($id_rapport);

            return view('vues/', compact('mesMedocs', 'id_rapport'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validateMedocOffert(Request $request)
    {

    }

    public function removeMedocOffert(int $id_rapport, int $id_medoc): void
    {

    }

    private function getMedicamentsOffert(int $id_rapport)
    {
        $serviceMedicament = new ServiceMedicament();
        $mesMedocs = $serviceMedicament->getMedicamentByVisite($id_rapport);
        foreach ($mesMedocs as $medoc) {
            $medoc->qte_offerte = $medoc->rapports[0]->pivot->qte_offerte;
        }
        return $mesMedocs;
    }

}
