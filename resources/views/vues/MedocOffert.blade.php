@extends('layouts.master')
@section('content')
<h1>Médicaments offerts</h1>

@php
    if (isset($monRapport)) {
        $nom_praticien = $monRapport->praticien->nom_praticien;
        $prenom_praticien = $monRapport->praticien->prenom_praticien;
        $nom_visiteur = $monRapport->visiteur->nom_visiteur;
        $prenom_visiteur = $monRapport->visiteur->prenom_visiteur;
    }
@endphp
<h2>
    {{$nom_praticien}} {{$prenom_praticien}} : {{$nom_visiteur}} {{$prenom_visiteur}}
    : {{$monRapport->date_rapport}}
    <small class="text-body-secondary">Gérer les médicaments offerts
        <a href="{!! route("modifierMedocOffert", ['idRap' => $monRapport->id_rapport]) !!}"><span
                class="glyphicon glyphicon-list"></span></a>
    </small>
</h2>
<div class="col-md-20  col-sm-16 well">
    @foreach($mesMedocs as $medoc)
        <h4>
            {{$medoc->nom_commercial}}

            <small>
                Quantité offerte: {{$medoc->qte_offerte}}
            </small>
            <a href="/supprimerMedocOffert/{{$monRapport->id_rapport}}/{{$medoc->id_medicament}}">
                <span class="glyphicon glyphicon-trash"></span>
            </a>
        </h4>
    @endforeach
</div>

@include('vues/error')
@stop