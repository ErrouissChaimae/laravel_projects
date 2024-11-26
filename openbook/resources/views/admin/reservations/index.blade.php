@extends('admin.layout')

@section('content')
<h1>Liste des Réservations</h1>

<a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Ajouter une Réservation</a>


<form class="container text-center mb-4"  action="{{ route('reservations.search') }}" method="POST">
    @csrf
    <div style="position: relative;">
        <input type="text" name="search"  style=" background-color: rgba(240, 232, 197, 0.623); 
            color: black; 
            border: none; 
            padding: 0.5rem; 
            border-radius: 0.25rem; 
            margin-top: 10px;
            width: 300px; " id="search" class="navbar-input" placeholder="Rechercher ">
        <button type="submit" class="btn btn-success">Rechercher</button>

    </div>
</form>  
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Personne</th>
            <th>Oeuvre</th>
            <th>Date d'Emprunt</th>
            <th>duree_d_emprunt</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id_res }}</td>
                <td>
                    @if ($reservation->membre)
                        {{ $reservation->membre->personne->nom }} {{ $reservation->membre->personne->prenom }}
                    @else
                        Membre inconnu
                    @endif
                </td>
                
                                <td>{{ $reservation->oeuvre->titre }}</td>
                <td>{{ $reservation->date_d_emprunt }}</td>
                <td>{{ $reservation->duree_d_emprunt}}</td>
                <td>
                    <a href="{{ route('reservations.show', $reservation->id_res) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('reservations.edit', $reservation->id_res) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('reservations.destroy', $reservation->id_res) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette réservation ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
