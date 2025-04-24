@extends('layouts.master')
@section('content')
<h1>{{$medicament->nom_commercial}} <small class="text-body-secondary">Gérer les composants
        <a href="{{route('modifierCompoMed', $medicament->id_medicament)}}">
            <span class="glyphicon glyphicon-list" data-toggle="tooltip" data-placement="top" title="Modifier">
            </span>
        </a></small>
</h1>
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <th style="width:30%">Libellé</th>
        <th style="width:30%">Quantité</th>
        <th style="width:20%">Supprimer</th>
    </thead>
    @foreach($composants as $composant)
        <tr>
            <td>{{$composant->lib_composant}}</td>
            <td>
                {{$composant->pivot->qte_composant}}
            </td>
            <td style="text-align:center;">
                <a href="{{route('supprimerCompoMed', [$medicament->id_medicament, $composant->id_composant])}}">
                    <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                        title="Supprimer"></span>
                </a>
            </td>
        </tr>
    @endforeach
</table>
@include('vues/error')
@stop