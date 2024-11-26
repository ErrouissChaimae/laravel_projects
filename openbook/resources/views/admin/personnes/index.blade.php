@extends('admin.layout')

@section('content')
    <h1 class="my-4">Gestion des Personnes</h1>
    
    <!-- Search Form -->
   
    
    
    <a href="{{ route('personnes.create') }}" class="btn btn-success mb-3">Ajouter une personne</a>
    <form class="container text-center mb-4"  action="{{ route('personnes.search') }}" method="POST">
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
        </form>
        </div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>CIN</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personnes as $personne)
                <tr>
                    <td>{{ $personne->id_pers }}</td>
                    <td>{{ $personne->cin }}</td>
                    <td>{{ $personne->nom }}</td>
                    <td>{{ $personne->prenom }}</td>
                    <td>{{ $personne->email }}</td>
                    <td>{{ $personne->tel }}</td>
                    <td>
                        <a href="{{ route('personnes.show', $personne->id_pers) }}" class="btn btn-primary btn-sm">Voir</a>

                        <a href="{{ route('personnes.edit', $personne->id_pers) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('personnes.destroy', $personne->id_pers) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette personne ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
