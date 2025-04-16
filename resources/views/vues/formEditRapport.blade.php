@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => '/validerRapport']) !!}

    <div class="col-md-20  col-sm-16 well well-md">
        <div class="form-horizontal">
            <input type="hidden" name="id_rapport" value="{{$id_rapport ?? 0}}"/>

            <div class="form-group">
                <label class="col-md-4 col-sm-3 control-label">Praticien : </label>
                <div class="col-md-6 col-md-3">
                    <select class="form-select" name="id_praticien" size="6" required>
                        <option value="" {{$id_praticien === 0 ? "selected": ""}} disabled>
                            Selectionner un praticien
                        </option>
                        @foreach($mesPraticiens as $praticien)
                            <option value="{{$praticien->id_praticien}}"
                                {{$id_praticien === $praticien->id_praticien ? "selected" : ""}}>
                                {{$praticien->nom_praticien}} {{$praticien->prenom_praticien}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 col-sm-3 control-label">Visiteur : </label>
                <div class="col-md-6 col-md-3">
                    <select class="form-select" name="id_visiteur" size="6" required>
                        <option value="" disabled>Selectionner un visiteur
                        </option>
                        @foreach($mesVisiteurs as $visiteur)
                            <option value="{{$visiteur->id_visiteur}}">
                                {{$visiteur->nom_visiteur}} {{$visiteur->prenom_visiteur}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 col-sm-3 control-label">Date : </label>
                <div class="col-md-6 col-md-3">
                    <input type="date" class="form-control" name="date" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 col-sm-3 control-label">Bilan : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" class="form-control" name="bilan" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 col-sm-3 control-label">Motif : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" class="form-control" name="motif" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-4">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = '/getRapport';">
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
