@extends('admin.layout')

@section('content')
<h1 style="color: #e36800">Liste des Emprunts</h1>

<a href="{{ route('emprunts.create') }}" class="btn btn-primary mb-3">Ajouter une emprunt</a>

<form class="container text-center mb-4"  action="{{ route('emprunts.search') }}" method="POST">
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
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Membre</th>
            <th>Oeuvre</th>
            <th>Date de Début</th>
            <th>Date de Fin</th>
            <th>Rendu</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($emprunts as $emprunt)
        <tr>
            <td>{{ $emprunt->id_emprunt }}</td>
            <td>{{ $emprunt->membre->personne->nom }} {{ $emprunt->membre->personne->prenom }}</td>
            <td>{{ $emprunt->oeuvre->titre }}</td>
            <td>{{ $emprunt->date_debut }}</td>
            <td>{{ $emprunt->date_fin }}</td>
            <td>{{ $emprunt->rendu }}</td>
            <td>
                <a href="{{ route('emprunts.show', $emprunt->id_emprunt) }}" class="btn btn-info">Voir</a>
                <a href="{{ route('emprunts.edit', $emprunt->id_emprunt) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('emprunts.destroy', $emprunt->id_emprunt) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
