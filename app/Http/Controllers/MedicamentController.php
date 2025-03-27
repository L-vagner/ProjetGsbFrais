<?php

namespace App\Http\Controllers;

use App\dao\ServiceMedicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;

class MedicamentController extends Controller
{
    public function rechercheMedicaments()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicaments = $serviceMedicament->getMedicaments();
            return view('vues/formFindCompo', compact('medicaments', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }

    }

    public function afficheCompoMed(Request $request)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $id_med = $request->input('id_med');
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicament = $serviceMedicament->getMedicamentById($id_med);
            $composants = $medicament->composants;
            return view('vues/listeCompo', compact('medicament', 'composants', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function updateCompoMed($id_med)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicament = $serviceMedicament->getMedicamentById($id_med);
            $composants = $medicament->composants;
            $titre_vue = $medicament->nom_commercial;
            return view('vues/formEditCompo', compact('id_med', 'composants', 'titre_vue', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validateCompoMed(Request $request)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');

        $qteComposants = $request->input('qte_compo');
        $id_med = $request->input('id_med');
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicament = $serviceMedicament->getMedicamentById($id_med);
            $medicament->updateQteComposant($qteComposants);

            $composants = $medicament->composants;
            return view('vues/listeCompo', compact('medicament', 'composants', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function addCompoMed()
    {

    }

}
