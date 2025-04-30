@extends('layouts.master')
@section('content')
    <h1>Liste de medicaments {{$title ?? ""}}</h1>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <th style="width:30%">Depot légal</th>
        <th style="width:30%">Nom commercial</th>
        <th style="width:20%">Famille</th>
        <th style="width:20%">Prix echantillon</th>
        <th style="width: 10%">Composants</th>
        </thead>
        @foreach($mesMedocs as $medoc)
            <tr>
                <td>{{$medoc->depot_legal}}</td>
                <td>{{$medoc->nom_commercial}}</td>
                <td>{{$medoc->famille->lib_famille}}</td>
                <td>{{$medoc->prix_echantillon}}</td>
                <td style="text-align:center;">
                    <a href="/getCompoMed?id_med={{$medoc->id_medicament}}">
                    <span class="glyphicon glyphicon-file" data-toggle="tooltip" data-placement="top"
                          title="Modifier">
                    </span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    @include('vues/error')
@stop
