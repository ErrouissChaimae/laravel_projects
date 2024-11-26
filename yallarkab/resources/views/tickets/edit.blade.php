@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Modifier le Ticket</h1>
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
    <form action="{{ route('tickets.update', $ticket->id_ticket) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="id_autocar">Autocar</label>
            <select name="id_autocar" id="id_autocar" class="form-control">
                @foreach ($autocars as $autocar)
                    <option value="{{ $autocar->id_autocar }}" {{ $ticket->id_autocar == $autocar->id_autocar ? 'selected' : '' }}>
                        {{ $autocar->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ville_depart">Ville de départ</label>
            <input type="text" name="ville_depart" id="ville_depart" class="form-control" value="{{ $ticket->ville_depart }}">
            <div id="ville_depart_suggestions" class="suggestions"></div>
        </div>

        <div class="form-group">
            <label for="ville_arrivee">Ville d'arrivée</label>
            <input type="text" name="ville_arrivee" id="ville_arrivee" class="form-control" value="{{ $ticket->ville_arrivee }}">
            <div id="ville_arrivee_suggestions" class="suggestions"></div>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $ticket->date }}">
        </div>

        <div class="form-group">
            <label for="heure_depart">Heure de départ</label>
            <input type="time" name="heure_depart" id="heure_depart" class="form-control" value="{{ $ticket->heure_depart }}">
        </div>

        <div class="form-group">
            <label for="heure_arrivee">Heure d'arrivée</label>
            <input type="time" name="heure_arrivee" id="heure_arrivee" class="form-control" value="{{ $ticket->heure_arrivee }}">
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $ticket->code }}">
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" name="prix" id="prix" class="form-control" value="{{ $ticket->prix }}">
        </div>
        <div class="form-group">
            <label for="quantite_tickets">quantite_tickets</label>
            <input type="text" name="quantite_tickets" id="quantite_tickets" class="form-control" value="{{ $ticket->quantite_tickets }}">
        </div>

        <button type="submit"class="btn btn-warning" style="color: rgb(255, 255, 255);background-color:orange; border-radius:50px; padding:10px 50px;">Mettre à jour</button>
    </form>
</div>
<br><br><br>
@endsection
@include('layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const villesUrl = "{{ asset('moroccan_cities.json') }}";
  
      function fetchCities(inputElement, suggestionsElementId) {
          inputElement.addEventListener('input', function () {
              const query = inputElement.value.toLowerCase();
              const suggestionsElement = document.getElementById(suggestionsElementId);
  
              fetch(villesUrl)
                  .then(response => response.json())
                  .then(cities => {
                      suggestionsElement.innerHTML = '';
                      const filteredCities = cities.filter(city => city.name.toLowerCase().startsWith(query));
                      filteredCities.forEach(city => {
                          const suggestion = document.createElement('div');
                          suggestion.classList.add('suggestion');
                          suggestion.textContent = city.name;
                          suggestion.addEventListener('click', () => {
                              inputElement.value = city.name;
                              suggestionsElement.innerHTML = '';
                          });
                          suggestionsElement.appendChild(suggestion);
                      });
                  });
          });
      }
  
      fetchCities(document.getElementById('ville_depart'), 'ville_depart_suggestions');
      fetchCities(document.getElementById('ville_arrivee'), 'ville_arrivee_suggestions');
  
      // Submission of the form
      document.getElementById('submitForm').addEventListener('click', function () {
          document.querySelector('.search-form').submit();
      });
  });
  </script>
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

    .suggestions {
   max-height: 100px; 
   width: 100%; 
   overflow-y: auto; 
   background-color: #f4f3f3;
   z-index: 1000;
  
   }

 .suggestion {
   padding: 10px;
   cursor: pointer;
 }

 .suggestion:hover {
   background-color: orange;
   color: #ffffff;
 }

 </style>