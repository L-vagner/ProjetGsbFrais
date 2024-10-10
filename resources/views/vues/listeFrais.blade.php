@extends('layouts.master')
@section('content')
	<h1>liste de frais</h1>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <th style="width:30%">Période</th>
        <th style="width:30%">Montant validé</th>
        <th style="width:20%">Modifier</th>
        <th style="width:20%">Supprimer</th>
        </thead>
        @foreach($mesFrais as $frais)
            <tr>
                <td>{{$frais->anneemois}}</td>
                <td>{{$frais->montantvalide}}</td>
                <td style="text-align:center;">
                    <a href="{{'/modifierFrais'}}/{{$frais->id_frais}}">
                    <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                          title="Modifier">
                    </span>
                    </a>
                </td>
                <td style="text-align:center;">
                    @if()
                    <a onclick="javascript:if (confirm('Suppression confirmée ?')) {
                    window.location='{{url('/supprimerFrais')}}/{{$frais->id_frais}}'
					}">
                        <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                              title="Supprimer"></span>
                    </a>
                    @else
                        <a onclick="javascript:if (confirm('Supprimer la fiches et tous les frais liés ?')) {
                    window.location='{{url('/supprimerFrais')}}/full/{{$frais->id_frais}}'
					}">
                        <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                              title="Supprimer"></span>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @include('vues/error')
@stop
