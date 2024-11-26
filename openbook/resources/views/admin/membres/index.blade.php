@extends('admin.layout')

@section('content')
    <h1>Liste des Membres</h1>
    
    
    <a href="{{ route('membres.create') }}" class="btn btn-primary mb-3">Ajouter un Membre</a>
    <form class="container text-center mb-4"  action="{{ route('membres.index') }}" method="POST">
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
        </form><br><br>
        <br>
        
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date d'inscription</th>
                <th>Mois Payé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membres as $membre)
                <tr>
                    <td>{{ $membre->id_m }}</td>
                    <td>{{ $membre->personne->nom }}</td>
                    <td>{{ $membre->personne->prenom }}</td>
                    <td>{{ $membre->personne->email }}</td>
                    <td>{{ $membre->personne->tel }}</td>
                    <td>{{ $membre->date_inscription }}</td>
                    <td>{{ $membre->mois_payer ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a href="{{ route('membres.show', $membre->id_m) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('membres.edit', $membre->id_m) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('membres.destroy', $membre->id_m) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce membre ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
