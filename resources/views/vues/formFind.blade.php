@extends('layouts.master')
@section('content')
    @if ($search == "médicament")
        {!! Form::open(['url' => '/getCompoMed', 'method' => 'get']) !!}
    @elseif ($search == "famille")
        {!! Form::open(['url' => '/getFamille', 'method' => 'get']) !!}
    @elseif ($search == "rapport")
        {!! Form::open(['url' => '/getRapport', 'method' => 'get']) !!}
    @endif

    <div class="col-md-12 well well-md">
        <h1>Recherche {{$title}}</h1>
        <div class="form-horizontal">
            <div class="form-group">
                @if ($search == "rapport")
                    <label class="col-md-3 control-label" for="searchbar">Recherche praticien</label>
                    <div class="col-md-6 col-md-3">
                        <input type="text" id="searchbar" class="form-control" placeholder="Nom praticien ou date">
                    </div>
                @else
                    <label class="col-md-3 control-label" for="searchbar">Recherche {{$search}}</label>
                    <div class="col-md-6 col-md-3">
                        <input type="text" id="searchbar" class="form-control" placeholder="Nom {{$search}}">
                    </div>
                @endif
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
                    @elseif ($search == "famille")
                        <select class="form-select" name="id_fam" id="select" size="5" required>
                            <option value="" id="disabled" style="display: none" disabled selected></option>
                            @foreach($formOptions as $option)
                                <option value="{{$option->id_famille}}">{{$option->lib_famille}}</option>
                            @endforeach
                        </select>
                    @elseif ($search == "rapport")
                                <select class="form-select" name="id_rap" id="select" size="3" required>
                                    <option value="" id="disabled" style="display: none" disabled selected></option>
                                    @foreach($formOptions as $option)

                                                    @php
                                                        $id_prat = $option->praticien->id_praticien;
                                                        $name = $option->praticien->nom_praticien;
                                                        $date = $option->date_rapport;
                                                    @endphp

                                                    <option value="{{$option->id_rapport}}" data-praticien="{{$name}}" data-date="{{$date}}"
                                                        data-id-praticien="{{$id_prat}}">{{$name}} {{$date}}</option>
                                    @endforeach
                                </select>
                    @endif
                </div>
                @if ($search == "rapport")
                    <div class="col">
                        <small class="text-body-secondary input-hidden" id="addRapport">
                            <a>
                                <span class="glyphicon glyphicon-plus-sign" data-toggle="tooltip" data-placement="top"
                                    title="Ajouter Rapport">
                                </span>
                            </a>
                            <span></span>
                        </small>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-default btn-primary"><span
                            class="glyphicon glyphicon-log-in"></span> 
                            @if($search == "rapport")
                            Modifier
                            @else
                            Valider
                            @endif
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
        const span = document.querySelector("#addRapport");

        let witch = "{{$search}}";
        let dateSearch = false;
        let min = 10;
        switch (witch) {
            case "médicament":
                break;
            case "famille":
                min = 5;
                break;
            case "rapport":
                min = 3;
                break;
        }

        function hideSelects(searchtext) {
            let escapedText = RegExp.escape(searchtext);
            let re = new RegExp(".*" + escapedText + ".*", 'i');
            let val = null;
            let i = 0;
            selectArray = Array.from(selectOptions);
            selectArray.map((node) => {
                let text = null;
                if (witch === "rapport") {
                    text = node.dataset.praticien + node.dataset.date;
                } else {
                    text = node.innerText;
                }
                if (re.test(text)) {
                    node.classList.remove('input-hidden');
                    val = node.getAttribute("value");
                    i++;
                } else {
                    node.classList.add('input-hidden');
                }

            })
            select.setAttribute('size', Math.min(min, i).toString());
            if (i === 1) {
                select.value = val;
                if (witch === "rapport") {
                    setLink(val)
                }

            } else {
                resetSelect()
            }

        }

        function resetSelect() {
            select.value = "";
            if (witch === "rapport") {
                span.classList.add("input-hidden")
                span.children[0].removeAttribute("href");
                span.children[1].innerText = "";
            }

        }

        function setLink(id) {
            span.classList.remove("input-hidden")
            let a = span.children[0];
            let option = document.querySelector("option[value=\"" + id + "\"]");
            let url = "/addRapport?id_prat=" + option.getAttribute("data-id-praticien");
            span.children[1].innerText = "Ajouter rapport " + option.getAttribute("data-praticien")
            a.setAttribute("href", url);

        }

        search.addEventListener('input', (event) => hideSelects(event.target.value));
    </script>
@endsection