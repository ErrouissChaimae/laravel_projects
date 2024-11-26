@extends('layouts.app2')
<style>
    .mini-hr {
           border: none; 
           height: 4px;
           background-color: #ff5e00; 
           width: 150px;
           margin: 0; 
           margin-top: -3px; 
           margin-bottom: 5px; 
           
       }
</style>
@section('content')
    <div class="container">
        <h1>Créer un Ticket :</h1>
        <hr class="mini-hr">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form id="ticketForm" action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_autocar">Autocar</label>
                <select name="id_autocar" id="id_autocar" class="form-control">
                    @foreach ($autocars as $autocar)
                        <option value="{{ $autocar->id_autocar }}">{{ $autocar->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ville_depart">Ville de départ</label>
                <div class="input-group">
                    <input type="text" name="ville_depart" id="ville_depart" class="form-control" autocomplete="off">
                    <div id="ville_depart_suggestions" class="suggestions"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="ville_arrivee">Ville d'arrivée</label>
                <input type="text" name="ville_arrivee" id="ville_arrivee" class="form-control" autocomplete="off">
                <div id="ville_arrivee_suggestions" class="suggestions"></div>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="heure_depart">Heure de départ</label>
                <input type="time" name="heure_depart" id="heure_depart" class="form-control">
            </div>
            <div class="form-group">
                <label for="heure_arrivee">Heure d'arrivée</label>
                <input type="time" name="heure_arrivee" id="heure_arrivee" class="form-control">
            </div>
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" class="form-control">
            </div>
            <div class="form-group">
                <label for="quantite_tickets">quantite_tickets</label>
                <input type="text" name="quantite_tickets" id="quantite_tickets" class="form-control">
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control">
            </div>
            <button type="button" id="submitForm" class="btn btn-warning" style="color: rgb(255, 255, 255);background-color:orange; border-radius:50px; padding:10px 50px;">Ajouter</button>
        <br></form>
    </div>
    <br>  <br>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const villesUrl = "{{ asset('moroccan_cities.json') }}";
    
        function fetchCities(inputElement, suggestionsElementId) {
            inputElement.addEventListener('input', function () { // Changer de 'focus' à 'input'
                const query = inputElement.value.toLowerCase();
                const suggestionsElement = document.getElementById(suggestionsElementId);
    
                fetch(villesUrl)
                    .then(response => response.json())
                    .then(cities => {
                        suggestionsElement.innerHTML = '';
                        const filteredCities = cities.filter(city => city.name.toLowerCase().startsWith(query));
                        filteredCities.forEach(city => {
                            const a = document.createElement('a');
                            a.classList.add('dropdown-item');
                            a.href = '#';
                            a.textContent = city.name;
                            a.addEventListener('click', () => {
                                inputElement.value = city.name;
                                suggestionsElement.innerHTML = '';
                            });
                            suggestionsElement.appendChild(a);
                        });
                    });
            });
        }
    
        fetchCities(document.getElementById('ville_depart'), 'ville_depart_suggestions');
        fetchCities(document.getElementById('ville_arrivee'), 'ville_arrivee_suggestions');
            document.getElementById('submitForm').addEventListener('click', function () {
            document.getElementById('ticketForm').submit();
        });
    });
</script>
    <style>
    .suggestions {
       
        background-color: #eae7e76b;
        border-right-color: 1px #4f4d4d;
        width: calc(100% - 2px);
        border-radius: 5px 5px 5px 5px;
        box-shadow:  1px rgb(227, 225, 225);
        max-height: 200px;
        overflow-y: auto;
    }
    
    .suggestions a {
        display: block;
        padding: 8px 12px;
        color: #4f4d4d;
        text-decoration: none;
    }
    
    .suggestions a:hover {
        background-color: #ff851b;
        color: rgb(255, 255, 255);
    }
    </style>
        @include('layouts.footer')

@endsection
