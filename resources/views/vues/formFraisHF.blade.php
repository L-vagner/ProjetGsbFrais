@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => '/validerFraisHF']) !!}
    <div class="col-md-12  col-sm-12 well well-md">
        <h1>{{$titreVue}}</h1>
        <div class="form-horizontal">
            <input type="hidden" name="id_fraisHF" value="{{$unFraisHF->id_fraishorsforfait}}"/>
            <input type="hidden" name="id_frais" value="{{$unFraisHF->id_frais}}">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Date : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="date" name="date_fraisHF" value="{{$unFraisHF->date_fraishorsforfait}}" class="form-control" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Libellé : </label>
                <div class="col-md-2  col-sm-2">
                    <input type="text" name="lib_fraisHF" min="0" value="{{$unFraisHF->lib_fraishorsforfait}}"  class="form-control" placeholder="libellé du frais" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Montant : </label>
                <div class="col-md-3 col-sm-3">
                    <span class="form-inline">
                        <input type="number" name="montant_fraisHF" step="0.1" value="{{$unFraisHF->montant_fraishorsforfait}}" class="form-control" required> &euro;
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = '{{route('listeFraisHF',$unFraisHF->id_frais)}}';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3  col-sm-6 col-sm-offset-3" id="erreur">
                @include('vues/error')
            </div>
        </div>
    </div>
@stop
