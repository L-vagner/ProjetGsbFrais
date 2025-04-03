@extends('layouts.master')
@section('content')
    {!! Form::open(['url'=>'/getCompoMed']) !!}
    <div class="col-md-12 well well-md">
        <h1>Recherche composants de médicament</h1>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label">Médicament : </label>
                <div class="col-md-6 col-md-3">
                    <select class="form-select" name="id_med">
                        @foreach($ as $medicament)
                            <option value="{{$medicament->id_medicament}}">{{$medicament->nom_commercial}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                @include('vues/error')
            </div>
        </div>
    </div>
@endsection
