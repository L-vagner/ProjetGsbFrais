@extends('layouts.master')
@section('content')
    <h1>Médicaments offerts</h1>

    @php
        if(isset($monRapport))
            {
                $nom_praticien = $monRapport->praticien->nom_praticien;
                $prenom_praticien = $monRapport->praticien->prenom_praticien;
                $nom_visiteur = $monRapport->visiteur->nom_visiteur;
                $prenom_visiteur = $monRapport->visiteur->prenom_visiteur;
            }
    @endphp
    <h2>
        {{$nom_praticien}} {{$prenom_praticien}} : {{$nom_visiteur}} {{$prenom_visiteur}}
        : {{$monRapport->date_rapport}}</h2>
    <div class="col-md-20  col-sm-16 well">
        @foreach($mesMedocs as $medoc)
            <h4>
                {{$medoc->nom_commercial}}
                <small>
                    Quantité offerte: {{$medoc->qte_offerte}}
                </small>
            </h4>
        @endforeach
    </div>

    @include('vues/error')
@stop
