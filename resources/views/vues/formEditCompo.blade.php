@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => '/validerCompo']) !!}

    <div class="col-md-20  col-sm-16 well well-md">
        <h1>{{$titre_vue}}</h1>
        <h4>{{$nom_medi}}</h4>
        <div class="form-horizontal">
            <input type="hidden" name="id_med" value="{{$id_med}}"/>
            @if($titre_vue === "Ajout de composants")
                <div class="form-group">
                    <label class="col-md-3 control-label" for="searchbar">Recherche composants</label>
                    <div class="col-md-6 col-md-3">
                        <input type="text" id="searchbar" class="form-control" placeholder="Nom composants">
                    </div>
                </div>
            @endif

            @foreach($composants as $composant)
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label">Quantité de {{$composant->lib_composant}} : </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="number" name="qte_compo[{{$composant->id_composant}}]"
                               {!! $qte_composant = isset($composant->pivot->qte_composant) ? $composant->pivot->qte_composant: 0 !!}
                               value="{{ $qte_composant}}" class="form-control"
                               autofocus>
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-4">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = '/getCompoMed?id_med={{$id_med}}';">
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

@if($titre_vue === "Ajout de composants")
    @section('scripts')
        <script type="text/javascript">
            const composantOptions = document.querySelectorAll('input[type="number"][name^="qte_compo"]');
            const search = document.querySelector("#searchbar");

            function hideSelects(searchtext) {
                let escapedText = RegExp.escape(searchtext)
                let re = new RegExp(".*" + escapedText + ".*", 'i');
                composantArray = Array.from(composantOptions);
                composantArray.map((node) => {
                    let text = node.parentElement.previousElementSibling.innerText;
                    if (re.test(text)) {
                        node.parentElement.parentElement.classList.remove('input-hidden');
                    } else {
                        node.parentElement.parentElement.classList.add('input-hidden');
                    }
                })
            }

            search.addEventListener('input', (event) => hideSelects(event.target.value));
        </script>
    @endsection
@endif
