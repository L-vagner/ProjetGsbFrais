@extends('layouts.master')
@section('content')

    <h1>
        Liste de rapports
        <small class="text-body-secondary">ajouter un rapport
            <a href="{!! route("ajouterRapport") !!}"><span class="glyphicon glyphicon-plus-sign"></span></a>
        </small>
        <small class="text-body-secondary">rechercher un rapport
            <a href="{!! route("findRapport") !!}"><span class="glyphicon glyphicon-search"></span></a>
        </small>
    </h1>

    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <tr>
            <th style="width:20%">Praticien</th>
            <th style="width:20%">Visiteur</th>
            <th style="width:20%">Date rapport</th>
            <th style="width:20%">Bilan</th>
            <th style="width:20%">Motif</th>
            <th>Médicaments offerts</th>
            <th>Modifier</th>
        </tr>
        </thead>
        @foreach($mesRapports as $rapport)
            @php
                $praticien = $rapport->praticien;
                $visiteur = $rapport->visiteur;
            @endphp
            <tr>
                <td>{{$praticien->nom_praticien}} {{$praticien->prenom_praticien}}</td>
                <td>{{$visiteur->nom_visiteur}} {{$visiteur->prenom_visiteur}}</td>
                <td>{{$rapport->date_rapport}}</td>
                <td>{{$rapport->bilan}}</td>
                <td>{{$rapport->motif}}</td>
                <td style="text-align: center">
                    <a href="/viewMedicamentOffert/{{$rapport->id_rapport}}">
                        <span class="glyphicon glyphicon-file" data-toggle="tooltip" data-placement="top"
                              title="consulter médicaments offerts">
                        </span>
                    </a>
                </td>
                <td style="text-align:center;">
                    <a href="{{route('updateRapport', [$rapport->id_rapport])}}">
                    <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                          title="Modifier">
                    </span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    @include('vues/error')
@stop
