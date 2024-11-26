@extends('admin.layout')

@section('content')
    <h1>Détails du Membre</h1>

    <div class="card">
        <div class="card-header">
            {{ $membre->personne->nom }} {{ $membre->personne->prenom }}
        </div>
        <div class="card-body">
            <p><strong>CIN:</strong> {{ $membre->personne->cin }}</p>
            <p><strong>Email:</strong> {{ $membre->personne->email }}</p>
            <p><strong>Téléphone:</strong> {{ $membre->personne->tel }}</p>
            <p><strong>Date d'inscription:</strong> {{ $membre->date_inscription }}</p>
            <p><strong>Mois Payé:</strong> {{ $membre->mois_payer ? 'Oui' : 'Non' }}</p>
            <p><strong>Adresse:</strong> {{ $membre->personne->adresse }}</p>
            <a style="background-color: rgb(224, 221, 221)" href="{{ route('membres.index') }}" class="btn btn">Retour
                
            </a>

        </div>
    </div>
@endsection
