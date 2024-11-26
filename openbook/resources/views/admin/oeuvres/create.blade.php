@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #e36800">Ajouter une Oeuvre</h1>

    <form action="{{ route('oeuvres.store') }}" method="POST" enctype="multipart/form-data" style="width: 70%; margin-left: 12%;">
        @csrf

        <br>
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="auteur">Auteur</label>
            <input type="text" name="auteur" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="date_parution">Date de Parution</label>
            <input type="date" name="date_parution" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="resumer">Résumé</label>
            <textarea name="resumer" class="form-control" required></textarea>
        </div>

        <br>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="quantite_stock">Quantité en Stock</label>
            <input type="number" name="quantite_stock" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="stocke_emprunt">Quantité à emprunter</label>
            <input type="number" name="stocke_emprunt" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <br>
        <center>
            <button type="submit" style="background-color: #e3a538" class="btn btn">Ajouter</button>
            <a style="background-color: rgb(224, 221, 221)" href="{{ route('oeuvres.index') }}" class="btn btn">Annuler</a>
        </center>
    </form>
</div>
@endsection
