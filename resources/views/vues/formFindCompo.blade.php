@extends('layouts.master')
@section('content')
    {!! Form::open(['url'=>'/getCompoMed']) !!}
    <div class="col-md-12 well well-md">
        <h1>Recherche composants de médicament</h1>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label" for="searchbar">Recherche medicament</label>
                <div class="col-md-6 col-md-3">
                    <input type="text" id="searchbar" class="form-control" placeholder="Nom médicament">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Médicament : </label>
                <div class="col-md-6 col-md-3">
                    <select class="form-select" name="id_med" id="select" required>
                        <option value="" id="disabled" style="display: none" disabled selected></option>
                        @foreach($medicaments as $medicament)
                            <option value="{{$medicament->id_medicament}}">{{$medicament->nom_commercial}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-default btn-primary"><span
                            class="glyphicon glyphicon-log-in"></span> Valider
                    </button>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                @include('vues/error')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const selectOptions = document.querySelectorAll("select option");
        const select = document.querySelector("#select");
        const search = document.querySelector("#searchbar");

        function hideSelects(searchtext) {
            let re = new RegExp(".*" + searchtext + ".*", 'i');
            selectArray = Array.from(selectOptions);
            selectArray.map((node) => {
                let text = node.innerText;
                if (re.test(text)) {
                    node.classList.remove('input-hidden');
                } else {
                    node.classList.add('input-hidden');
                }

            })
            resetSelect()
        }

        function resetSelect() {
            select.value = "";
        }

        search.addEventListener('input', (event) => hideSelects(event.target.value));
    </script>
@endsection
