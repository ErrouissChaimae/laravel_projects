@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #e36800">Détails de la Personne</h1>

    <div class="form-group">
        <label for="cin">CIN</label>
        <input type="text" id="cin" name="cin" class="form-control" value="{{ $personne->cin }}" readonly>
    </div>

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" class="form-control" value="{{ $personne->nom }}" readonly>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" class="form-control" value="{{ $personne->prenom }}" readonly>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $personne->email }}" readonly>
    </div>

    <div class="form-group">
        <label for="tel">Téléphone</label>
        <input type="text" id="tel" name="tel" class="form-control" value="{{ $personne->tel }}" readonly>
    </div>

    <div class="form-group">
        <label for="adresse">Adresse</label>
        <textarea id="adresse" name="adresse" class="form-control" readonly>{{ $personne->adresse }}</textarea>
    </div>
<br>
    <center><a href="{{ route('personnes.index') }}" class="btn btn-secondary">Retour</a></center>
</div>
@endsection
