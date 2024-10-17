<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFraisHF;
use App\Models\Frais;
use Exception;

class FraisHFController extends Controller
{
    public function getFraisHF($id_frais)
    {
        $erreur ="";
        try {
            $serviceFraisHF = new ServiceFraisHF();
            $mesFraisHF = $serviceFraisHF->getFraisHF($id_frais);
            $sommeMontant = $serviceFraisHF->getMontantFraisHF($id_frais);
            return view('vues/listeFraisHF', compact('mesFraisHF', 'sommeMontant', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
}
