<?php

namespace App\Http\Controllers;

use App\dao\ServiceFrais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFraisHF;
use App\Models\FraisHF;
use Exception;

class FraisHFController extends Controller
{
    public function getFraisHF($id_frais)
    {
        Session::forget('montant');
        $erreur = "";
        try {
            $serviceFraisHF = new ServiceFraisHF();
            $mesFraisHF = $serviceFraisHF->getFraisHF($id_frais);
            $sommeMontant = $serviceFraisHF->getMontantFraisHF($id_frais);
            Session::put('id_frais', $id_frais);
            Session::put('montant', $sommeMontant);
            return view('vues/listeFraisHF', compact('mesFraisHF', 'sommeMontant', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function updateFraisHF($id_fraisHF)
    {
        $erreur = "";
        try {
            $serviceFraisHF = new ServiceFraisHF();
            $unFraisHF = $serviceFraisHF->getById($id_fraisHF);
            $titreVue = "Modification d'un frais Hors forfait";
            return view('vues/formFraisHF', compact('unFraisHF', 'titreVue', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validerFraisHF(Request $request)
    {
        $erreur = "";
        try {
            $serviceFraisHF = new ServiceFraisHF();
            $id_frais = $request->input('id_frais');
            $id_fraisHF = $request->input('id_fraisHF');
            $date_fraisHF = $request->input('date_fraisHF');
            $lib_fraisHF = $request->input('lib_fraisHF');
            $montant_fraisHF = $request->input('montant_fraisHF');
            if ($id_fraisHF > 0) {
                $serviceFraisHF->updateFraisHF($id_fraisHF, $date_fraisHF, $lib_fraisHF, $montant_fraisHF);
            } else {
                $serviceFraisHF->insertFraisHF($id_frais, $date_fraisHF, $lib_fraisHF, $montant_fraisHF);
            }
            return redirect()->route('listeFraisHF', ['id' => $id_frais]);
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function addFraisHF($id_frais)
    {
        $erreur = "";
        try {
            $unFraisHF = new FraisHF();
            $unFraisHF->id_fraishorsforfait = 0;
            $unFraisHF->id_frais = $id_frais;
            $titreVue = "Création d'un frais hors forfait";
            return view('vues/formFraisHF', compact('unFraisHF', 'titreVue', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function removeFraisHF($id_fraisHF)
    {
        $erreur = "";
        try {
            $serviceFraisHF = new ServiceFraisHF();
            $id_frais = $serviceFraisHF->getIdFrais($id_fraisHF);
            $serviceFraisHF->deleteFraisHF($id_fraisHF);
            return redirect()->route('listeFraisHF', ['id' => $id_frais->id_frais]);
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function confirmerFraisHF($id_frais)
    {
        $erreur = "";
        try {
            if ($id_frais != Session::get('id_frais')) throw new Exception("La fiche de frais ouvert n'est pas la même que la fiche de frais validé!");
            $serviceFrais = new ServiceFrais();
            $montant = Session::get('montant');
            $serviceFrais->confirmFraisHF($id_frais, $montant);
            Session::forget('montant');
            Session::forget('id_frais');
            return redirect('/modifierFrais/'.$id_frais);
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
}
