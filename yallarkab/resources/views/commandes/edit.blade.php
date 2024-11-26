@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la Commande #{{ $commande->id_commande }}</h1>
    <form action="{{ route('commandes.update', $commande->id_commande) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_ticket">Ticket</label>
            <select name="id_ticket" id="id_ticket" class="form-control" required>
                @foreach ($tickets as $ticket)
                    <option value="{{ $ticket->id_ticket }}" {{ $ticket->id_ticket == $commande->id_ticket ? 'selected' : '' }}>
                        {{ $ticket->ville_depart }} à {{ $ticket->ville_arrivee }} - {{ $ticket->prix }} Dhs
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_client">Client</label>
            <select name="id_client" id="id_client" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $commande->id_client ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="adults">Nombre d'Adultes</label>
            <input type="number" name="adults" id="adults" class="form-control" value="{{ $commande->adults }}" required>
        </div>
        <div class="form-group">
            <label for="children">Nombre d'Enfants</label>
            <input type="number" name="children" id="children" class="form-control" value="{{ $commande->children }}" required>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="{{ $commande->quantite }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>
@endsection
