@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => '/validerCompo']) !!}

    <div class="col-md-12  col-sm-12 well well-md">
        <h1>{{$titre_vue}}</h1>
        <div class="form-horizontal">
            <input type="hidden" name="id_med" value="{{$id_med}}"/>
            @foreach($composants as $composant)
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Quantité de {{$composant->lib_composant}} : </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="number" name="qte_compo[{{$composant->id_composant}}]"
                               value="{{$composant->pivot->qte_composant}}" class="form-control"
                               autofocus>
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = '/findCompoMed';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler
                    </button>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3  col-sm-6 col-sm-offset-3" id="erreur">
                @include('vues/error')
            </div>
        </div>
    </div>
@stop
