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
            $titre_vue = "Modification de quantité de composants";
            $composants = $medicament->composants;
            $nom_medi = $medicament->nom_commercial;
            return view('vues/formEditCompo', compact('id_med', 'titre_vue','composants', 'nom_medi', 'erreur'));
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

    public function addCompoMed($id_med)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicament = $serviceMedicament->getMedicamentById($id_med);
            $composants = $serviceMedicament->getMissingCompoMed($id_med);
            $titre_vue = "Ajout de composants";
            $nom_medi = $medicament->nom_commercial;
            return view('vues/formEditCompo', compact('id_med', 'titre_vue', 'nom_medi', 'composants', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function removeCompoMed($id_med, $id_compo)
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceMedicament = new ServiceMedicament();
            $medicament = $serviceMedicament->getMedicamentById($id_med);
            $medicament->removeComposant($id_compo);
            $composants = $medicament->composants;
            return view('vues/listeCompo', compact('medicament', 'composants', 'erreur'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

}
