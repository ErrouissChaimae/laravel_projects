@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #e36800">Modifier une Oeuvre</h1>

    <form action="{{ route('oeuvres.update', $oeuvre->id_livre) }}" method="POST" enctype="multipart/form-data" style="width: 70%; margin-left: 12%;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ $oeuvre->titre }}" required>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" class="form-control" value="{{ $oeuvre->genre }}" required>
        </div>

        <div class="form-group">
            <label for="auteur">Auteur</label>
            <input type="text" name="auteur" class="form-control" value="{{ $oeuvre->auteur }}" required>
        </div>

        <div class="form-group">
            <label for="date_parution">Date de Parution</label>
            <input type="date" name="date_parution" class="form-control" value="{{ $oeuvre->date_parution }}" required>
        </div>

        <div class="form-group">
            <label for="resumer">Résumé</label>
            <textarea name="resumer" class="form-control" required>{{ $oeuvre->resumer }}</textarea>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="{{ $oeuvre->prix }}" required>
        </div>

        <div class="form-group">
            <label for="quantite_stock">Quantité en Stock</label>
            <input type="number" name="quantite_stock" class="form-control" value="{{ $oeuvre->quantite_stock }}" required>
        </div>

        <div class="form-group">
            <label for="stocke_emprunt">Quantité à emprunter</label>
            <input type="number" name="stocke_emprunt" class="form-control" value="{{ $oeuvre->stocke_emprunt }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            @if($oeuvre->image)
                <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="max-width: 100px;">
            @endif
            <input type="file" name="image" class="form-control-file">
        </div>

        <center>
            <button type="submit" style="background-color: #e3a538" class="btn btn">Modifier</button>
            <a style="background-color: rgb(224, 221, 221)" href="{{ route('oeuvres.index') }}" class="btn btn">Annuler</a>
        </center>
    </form>
</div>
@endsection
