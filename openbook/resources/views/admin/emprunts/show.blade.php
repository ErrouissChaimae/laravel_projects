@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #e36800">Détails de l'Emprunt</h1>
    
    <div class="card" style="width: 80%;margin-left:5%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if($emprunt->oeuvre->image)
                    <img src="{{ asset('storage/' . $emprunt->oeuvre->image) }}" class="card-img" alt="{{ $emprunt->oeuvre->titre }}">
                @else
                    <img src="{{ asset('placeholder.jpg') }}" class="card-img" alt="Placeholder">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Membre: {{ $emprunt->membre->personne->nom }} {{ $emprunt->membre->personne->prenom }}</h5>
                    <p class="card-text">Oeuvre: {{ $emprunt->oeuvre->titre }}</p>
                    <p class="card-text">Date de Début: {{ $emprunt->date_debut }}</p>
                    <p class="card-text">Date de Fin: {{ $emprunt->date_fin }}</p>
                    <p class="card-text">Rendu: {{ $emprunt->rendu }}</p>
                    <a href="{{ route('emprunts.index') }}" class="btn btn-primary">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
