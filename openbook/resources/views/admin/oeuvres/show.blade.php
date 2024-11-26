@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #e36800">Détails de l'Oeuvre</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $oeuvre->titre }}</h2>
        </div>
        <div class="row no-gutters">
            <div class="col-md-4">
                @if($oeuvre->image)
                    <img src="{{ asset('storage/' . $oeuvre->image) }}" class="card-img" alt="{{ $oeuvre->titre }}" style="max-width: 100%;">
                @else
                    <img src="{{ asset('placeholder.jpg') }}" class="card-img" alt="Placeholder" style="max-width: 100%;">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p><strong>Genre:</strong> {{ $oeuvre->genre }}</p>
                    <p><strong>Auteur:</strong> {{ $oeuvre->auteur }}</p>
                    <p><strong>Date de Parution:</strong> {{ $oeuvre->date_parution }}</p>
                    <p><strong>Résumé:</strong> {{ $oeuvre->resumer }}</p>
                    <p><strong>Prix:</strong> {{ $oeuvre->prix }}</p>
                    <p><strong>Quantité en Stock:</strong> {{ $oeuvre->quantite_stock }}</p>
                    <p><strong>Quantité à emprunter:</strong> {{ $oeuvre->stocke_emprunt }}</p>
                    <a href="{{ route('oeuvres.index') }}" class="btn btn-primary">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
