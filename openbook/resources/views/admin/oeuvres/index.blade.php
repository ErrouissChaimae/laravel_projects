@extends('admin.layout')

@section('content')
<h1>Liste des Oeuvres</h1>
 

    <a href="{{ route('oeuvres.create') }}" class="btn btn-primary mb-3">Ajouter une Oeuvre</a>
    <form class="container text-center mb-4"  action="{{ route('oeuvres.search') }}" method="POST">
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
                <th>Titre</th>
                <th>Image</th>                
                <th>Genre</th>
                <th>Prix</th>
                <th>Quantité en Stock</th>
                <th>Quantité à emprunter</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($oeuvres as $oeuvre)
                <tr>
                    <td>{{ $oeuvre->titre }}</td>
                    <td>
                        @if($oeuvre->image)
                            <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="max-width: 100px;">
                        @endif
                    </td>
                    <td>{{ $oeuvre->genre }}</td>
                    <td>{{ $oeuvre->prix }}</td>
                    <td>{{ $oeuvre->quantite_stock }}</td>
                    <td>{{ $oeuvre->stocke_emprunt }}</td>
                    <td>
                        <a href="{{ route('oeuvres.show', $oeuvre->id_livre) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('oeuvres.edit', $oeuvre->id_livre) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('oeuvres.destroy', $oeuvre->id_livre) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette oeuvre ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection