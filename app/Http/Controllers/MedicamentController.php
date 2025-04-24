<?php

namespace App\Http\Controllers;

use App\dao\ServiceFamille;
use App\dao\ServiceMedicament;
use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use function PHPUnit\Framework\isEmpty;

class MedicamentController extends Controller
{
    public function rechercheMedicaments()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceMedicament = new ServiceMedicament();
            $formOptions = $serviceMedicament->getMedicaments();
            $title = "composants de médicament";
            $search = "médicament";
            return view('vues/formFind', compact('title', 'search', 'formOptions', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function rechercheFamille()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceFamille = new ServiceFamille();
            $formOptions = $serviceFamille->getFamilles();
            $title = "médicament par famille";
            $search = "famille";
            return view('vues/formFind', compact('title', 'search', 'formOptions', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function afficheCompoMed()
    {
        $id_med = $_GET['id_med'];
        $erreur = Session::get('erreur');
        Session::forget('erreur');
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
            $titre_vue = "Modification des composants";
            $mesComposants = $medicament->composants;
            $nom_medi = $medicament->nom_commercial;
            $missingComposants = $serviceMedicament->getMissingCompoMed($id_med);

            return view(
                'vues/formEditCompo',
                compact(
                    'id_med',
                    'nom_medi',
                    'titre_vue',
                    'mesComposants',
                    'missingComposants',
                    'erreur'
                )
            );
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

    public function getMedicaments()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $mesMedocs = Medicament::all();
            return view('vues/listeMedoc', compact('mesMedocs', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function afficheMedParFam()
    {
        $id_fam = $_GET['id_fam'];
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $serviceMedicament = new ServiceMedicament();
            $mesMedocs = $serviceMedicament->getMedicamentByFamille($id_fam);
            $title = ": " . $mesMedocs->first()->famille->lib_famille;
            return view('vues/listeMedoc', compact('mesMedocs', 'title', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
}
