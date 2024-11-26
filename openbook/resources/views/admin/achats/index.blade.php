@extends('admin.layout')

@section('content')
<h1 style="color: #e36800">Liste des Achats</h1>


<a href="{{ route('achats.create') }}" class="btn btn-primary mb-3">Ajouter une achat</a>

<form class="container text-center mb-4" action="{{ route('achats.index') }}" method="POST">
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
            <th>Personne</th>
            <th>Oeuvre</th>
            <th>Quantité</th>
            <th>Prix Total</th>
            <th>Prix TTC</th>
            <th>Date d'Achat</th>
            <th>Livré</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($achats as $achat)
        <tr>
            <td>{{ $achat->id_ach }}</td>
            <td>{{ $achat->personne->nom }} {{ $achat->personne->prenom }}</td>
            <td>{{ $achat->oeuvre->titre }}</td>
            <td>{{ $achat->qts_achete }}</td>
            <td>{{ $achat->prix_totale }}</td>
            <td>{{ $achat->prix_ttc }}</td>
            <td>{{ $achat->date_achat }}</td>
            <td>{{ $achat->livrer == 1 ? 'oui' : 'non' }}</td>
            <td>
                <a href="{{ route('achats.show', $achat->id_ach) }}" class="btn btn-info">Voir</a>
                <a href="{{ route('achats.edit', $achat->id_ach) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('achats.destroy', $achat->id_ach) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table><div class="pagination">
    {{ $achats->links() }}
</div>

@endsection
