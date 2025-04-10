@extends('layouts.master')
@section('content')
    @if ($search == "médicament")
        {!! Form::open(['url'=>'/getCompoMed', 'method'=>'get']) !!}
    @else
        {!! Form::open(['url'=>'/getFamille', 'method' => 'get']) !!}
    @endif

    <div class="col-md-12 well well-md">
        <h1>Recherche {{$title}}</h1>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label" for="searchbar">Recherche {{$search}}</label>
                <div class="col-md-6 col-md-3">
                    <input type="text" id="searchbar" class="form-control" placeholder="Nom {{$search}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">{{mb_ucfirst($search)}} : </label>
                <div class="col-md-6 col-md-3">
                    @if ($search == "médicament")
                        <select class="form-select" name="id_med" id="select" size="10" required>
                            <option value="" id="disabled" style="display: none" disabled selected></option>
                            @foreach($formOptions as $option)
                                <option value="{{$option->id_medicament}}">{{$option->nom_commercial}}</option>
                            @endforeach
                        </select>
                    @else
                        <select class="form-select" name="id_fam" id="select" size="5" required>
                            <option value="" id="disabled" style="display: none" disabled selected></option>
                            @foreach($formOptions as $option)
                                <option value="{{$option->id_famille}}">{{$option->lib_famille}}</option>
                            @endforeach
                        </select>
                    @endif
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
            let escapedText = RegExp.escape(searchtext);
            let re = new RegExp(".*" + escapedText + ".*", 'i');
            let i = 0;
            selectArray = Array.from(selectOptions);
            selectArray.map((node) => {
                let text = node.innerText;
                if (re.test(text)) {
                    node.classList.remove('input-hidden');
                    i++;
                } else {
                    node.classList.add('input-hidden');
                }

            })
            select.setAttribute('size', Math.min({{$search == "médicament" ? 10 : 5}}, i).toString());
            resetSelect()
        }

        function resetSelect() {
            select.value = "";
        }

        search.addEventListener('input', (event) => hideSelects(event.target.value));
    </script>
@endsection
