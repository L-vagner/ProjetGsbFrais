<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFrais;
use App\Models\Frais;
use Exception;

class FraisController extends Controller
{
    public function getFraisVisiteur()
    {

        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $id = Session::get('id');
            $serviceFrais = new ServiceFrais();
            $mesFrais = $serviceFrais->getFrais($id);
            return view('vues/listeFrais', compact('mesFrais', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function updateFrais($id_Frais) //mets a jour un frais
    {
        $erreur = "";
        try {
            $serviceFrais = new ServiceFrais();
            $unFrais = $serviceFrais->getById($id_Frais);
            $titreVue = "Modification d'une fiche de frais";
            return view('vues/formFrais', compact('unFrais', 'titreVue', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validateFrais(Request $request) //
    {
        $erreur = "";
        try {
            $id_frais = $request->input('id_frais');
            $anneemois = $request->input('anneemois');
            $nbjustificatifs = $request->input('nbjustificatifs');
            $serviceFrais = new ServiceFrais();
            if ($id_frais > 0) {
                $serviceFrais->updateFrais($id_frais, $anneemois, $nbjustificatifs);
            } else {
                $id_visiteur = Session::get('id');
                $serviceFrais->insertFrais($id_visiteur, $anneemois, $nbjustificatifs);
            }
            return redirect('/getListeFrais');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function addFrais()
    {
        $erreur = "";
        try {
            $unFrais = new Frais();
            $unFrais->id_frais = 0;
            $titreVue  = "Création d'une fiche de frais";
            return view('vues/formFrais', compact('unFrais', 'titreVue', 'erreur'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function removeFrais($id_frais)
    {
        $erreur = "";
        try {
            $serviceFrais = new ServiceFrais();
            $serviceFrais->deleteFrais($id_frais);
        } catch (Exception $e) {
            Session::put('erreur', $e->getMessage());
        }
        return redirect('/getListeFrais');
    }

    public function removeFraisFull($id_frais)
    {
        $erreur = "";
        try {
            $serviceFrais = new ServiceFrais();
            $serviceFrais->deleteFraisFull($id_frais);
        } catch (Exception $e) {
            Session::put('erreur', $e->getMessage());
        }
    }
}
