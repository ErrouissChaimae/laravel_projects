@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4" style="color: #e36800">Ajouter une Personne</h1>

    <form action="{{ route('personnes.store') }}" method="POST" style="width: 70%; margin-left: 12%;">
        @csrf

        <div class="form-group">
            <label for="cin">CIN</label>
            <input type="text" id="cin" name="cin" class="form-control" value="{{ old('cin') }}" required>
            @error('cin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
            @error('prenom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tel">Téléphone</label>
            <input type="text" id="tel" name="tel" class="form-control" value="{{ old('tel') }}" required>
            @error('tel')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea id="adresse" name="adresse" class="form-control" required>{{ old('adresse') }}</textarea>
            @error('adresse')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <center>
            <button type="submit" style="background-color: #e3a538" class="btn btn">Ajouter</button>
            <a style="background-color: rgb(224, 221, 221)" href="{{ route('personnes.index') }}" class="btn btn">Annuler</a>
        </center>
    </form>
</div>
@endsection
