@extends('layouts.master')
@section('content')
    <h1>liste des frais hors forfait</h1>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <th style="width:20%">Date</th>
        <th style="width:30%">Libellé</th>
        <th style="width:30%">Montant</th>
        <th style="width:10%">Modifier</th>
        <th style="width:10%">Supprimer</th>
        </thead>
        <tbody>
        @foreach($mesFraisHF as $fraisHF)
            <tr>
                <td>{{$fraisHF->date_fraishorsforfait}}</td>
                <td>{{$fraisHF->lib_fraishorsforfait}}</td>
                <td>{{$fraisHF->montant_fraishorsforfait}}</td>
                <td style="text-align:center;">
                    <a href="{{route('modifierFraisHF', $fraisHF->id_fraishorsforfait)}}">
                    <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                          title="Modifier">
                    </span>
                    </a>
                </td>
                <td style="text-align:center;">
                    <a onclick="javascript:if (confirm('Suppression confirmée ?')) {
                        window.location='{{url('/supprimerFraisHF')}}/{{$fraisHF->id_fraishorsforfait}}'
                    }">
                        <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                              title="Supprimer"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <th colspan="2" class="table-striped text-right">Montant total</th>
            <th style="width: 30%" class="table-striped">{{$sommeMontant}} €</th>
        </tr>
        </tbody>
    </table>
    @include('vues/error')
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <a href="{{url('/ajouterFraisHF/'.$mesFraisHF[0]->id_frais)}}"><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</button></a>
            <a href="{{url('/confirmerFraisHF/'.$mesFraisHF[0]->id_frais)}}"><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-check"></span> Valider les montants</button></a>
            <a href="{{url('/modifierFrais/'.$mesFraisHF[0]->id_frais)}}"><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-remove"></span> Annuler</button></a>
    </div>
    </div>
@stop
