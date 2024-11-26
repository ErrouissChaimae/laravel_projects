@extends('admin.layout')

@section('content')<br>
<h1 style="color: #e36800">Ajouter un Emprunt</h1>
<br><br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('emprunts.store') }}" method="POST" style="width: 70%;margin-left:12%; ">
    @csrf
    <div class="form-group">
        <label for="id_membre">Membre</label>
        <select name="id_membre" class="form-control">
            @foreach($membres as $membre)
                <option value="{{ $membre->id_m }}">{{ $membre->personne->email }} </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="id_livre">Oeuvre</label>
        <select name="id_livre" class="form-control">
            @foreach($oeuvres as $oeuvre)
                <option value="{{ $oeuvre->id_livre }}">{{ $oeuvre->titre }}</option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="date_debut">Date de Début</label>
        <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
    </div><br>
    <div class="form-group">
        <label for="date_fin">Date de Fin</label>
        <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
    </div><br>
    <div class="form-group">
        <label for="rendu">Rendu</label>
        <select name="rendu" class="form-control">
            <option value="oui" {{ old('rendu') == 'oui' ? 'selected' : '' }}>Oui</option>
            <option value="non" {{ old('rendu') == 'non' ? 'selected' : '' }}>Non</option>
        </select>
    </div><br>
    <center><button type="submit" style="background-color: #e3a538" class="btn btn">Ajouter</button>
        <a style="background-color: rgb(224, 221, 221)"  href="{{route('emprunts.index')}}" class="btn btn">Annuler</a></center></form>
@endsection
