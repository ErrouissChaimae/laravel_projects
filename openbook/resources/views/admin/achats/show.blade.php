@extends('admin.layout')

@section('content')
<div class="container">
    <h1 style="color: #e36800">Détails de l'Achat</h1>
<br>
    <div class="card" style="width: 80%;margin-left:5%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if($achat->oeuvre->image)
                    <img src="{{ asset('storage/' . $achat->oeuvre->image) }}" class="card-img" alt="{{ $achat->oeuvre->titre }}">
                @else
                    <img src="{{ asset('placeholder.jpg') }}" class="card-img" alt="Placeholder">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Personne: {{ $achat->personne->nom }} {{ $achat->personne->prenom }}</h5>
                    <p class="card-text">Oeuvre: {{ $achat->oeuvre->titre }}</p>
                    <p class="card-text">Quantité: {{ $achat->qts_achete }}</p>
                    <p class="card-text">Prix Total: {{ $achat->prix_totale }}</p>
                    <p class="card-text">Prix TTC: {{ $achat->prix_ttc }}</p>
                    <p class="card-text">Date d'Achat: {{ $achat->date_achat }}</p>
                    <p class="card-text">Livré: {{ $achat->livrer }}</p>
                    <a href="{{ route('achats.index') }}" class="btn btn-primary">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
