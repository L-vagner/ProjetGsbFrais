@extends('layouts.master')
@section('content')

    {!! Form::open(['url' => '/validerMedocOffert']) !!}

    <div class="col-md-20  col-sm-16 well well-md">
        <h1>Modification médicaments offerts</h1>
        <div class="form-horizontal">

            <input type="hidden" name="id_rap" value="{{ $id_rapport }}">
            <div class="col-md-offset-2 form-text">
                Les valeurs 0 sont ignorées, si vous désirez supprimer un médicament offert, faite le depuis la page
                précédente.
            </div>

            @foreach ($mesMedocs as $medoc)
                <div class="form-group">
                    <label class="col-md-4 col-sm-3 control-label">Quantité de {{$medoc->nom_commercial}} : </label>
                    <div class="col-md-2 col-sm-2">
                        <input type="number" name="qte_offerte[{{$medoc->id_medicament}}]"
                         {!! $qte_offerte = isset($medoc->qte_offerte) ? $medoc->qte_offerte : 0 !!} value="{{ $qte_offerte }}"
                            class="form-control">
                    </div>
                </div>
            @endforeach
            <div class="form-group" id="Add-button">

                <label class="control-label col-md-4">Ajouter un médicament</label>
                <div class="col-md-3">
                    <select class="form-select" size=4>
                        @foreach ($missingMedicaments as $medicament)
                            <option value="{{ $medicament->id_medicament }}">
                                {{ $medicament->nom_commercial }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="button" onclick="addSelection()">Ajouter</button>
            </div>

            <div class="form-group">
                <label class="control-label col-md-4">Rechercher un médicament à offrir</label>
                <div class="col-md-3">
                    <input type="text" name="" id="search-medoc" class="form-control"
                        placeholder="Recherche de médicaments" />
                </div>

            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4 col-md-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary" onclick="window.location = '/getRapport';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler
                    </button>
                </div>
            </div>


            <div class="col-md-6 col-md-offset-3  col-sm-6 col-sm-offset-3" id="erreur">
                @include('vues/error')
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script text="text/javascript">
        const select = document.querySelector('select');
        const form = document.querySelector("div.form-horizontal");
        const button = form.children.namedItem('Add-button');
        const search = document.querySelector('#search-medoc');

        function addSelection() {
            if (select.value == false)
                return;

            let option = select.selectedOptions[0];
            option.innerText = option.innerText.toString().replace('\n', '').trim();

            let node = document.createElement('div');
            node.classList.add('form-group');
            let label = document.createElement('label');
            label.classList.add('col-md-4', 'col-sm-3', 'control-label')
            label.innerText = "Quantité de " + option.innerText + " : ";

            let div = document.createElement('div');
            div.classList.add('col-md-2', 'col-sm-2');

            let input = document.createElement('input');
            input.classList.add('form-control')
            input.setAttribute('type', 'number');
            input.setAttribute('name', 'qte_offerte[' + option.value + ']');
            input.setAttribute('value', '0');
            div.appendChild(input);

            option.remove();
            search.value = "";
            resetSelect(true);
            setSize();
            node.appendChild(label);
            node.appendChild(div);
            form.insertBefore(node, button);

        }

        function hideSelects(searchtext) {
            let escapedText = RegExp.escape(searchtext);
            let re = new RegExp(".*" + escapedText + ".*", 'i');
            let selectOptions = Array.from(select.children);
            let i = 0;
            let val = null;

            selectOptions.map((e) => {
                if (re.test(e.innerText)) {
                    e.classList.remove('input-hidden');
                    val = e.getAttribute("value");
                    i++
                }
                else {
                    e.classList.add('input-hidden');
                }
            })
            setSize(i);
            if (i === 1) {
                select.value = val;
            }
            else {
                resetSelect();
            }
        }

        function resetSelect(complete = false) {
            select.value = "";
            if (complete) {
                let array = Array.from(select.children);
                array.map((e) => e.classList.remove('input-hidden'))
            }
        }



        function setSize(int = 4) {
            let min = 4;
            select.setAttribute('size', Math.min(min, int).toString());
        }

        search.addEventListener('input', (event) => hideSelects(event.target.value))
    </script>

@endsection