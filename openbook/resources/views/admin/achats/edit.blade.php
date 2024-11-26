@extends('admin.layout')

@section('content')
<br>
<h1 style="color: #e36800">Modifier l'Achat</h1>
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

<form action="{{ route('achats.update', $achat->id_ach) }}" method="POST"style="width: 70%;margin-left:12%; ">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="id_pers">Personne</label>
        <select name="id_pers" class="form-control">
            @foreach($personnes as $personne)
                <option value="{{ $personne->id_pers }}" {{ $achat->id_pers == $personne->id_pers ? 'selected' : '' }}>
                    {{ $achat->personne->cin }} 
                </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="id_livre">Oeuvre</label>
        <select name="id_livre" class="form-control">
            @foreach($oeuvres as $oeuvre)
                <option value="{{ $oeuvre->id_livre }}" {{ $achat->id_livre == $oeuvre->id_livre ? 'selected' : '' }}>
                    {{ $oeuvre->titre }}
                </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="qts_achete">Quantité</label>
        <input type="number" name="qts_achete" class="form-control" value="{{ $achat->qts_achete }}" required>
    </div><br>
    <div class="form-group">
        <label for="date_achat">Date d'Achat</label>
        <input type="date" name="date_achat" class="form-control" value="{{ $achat->date_achat }}" readonly>
    </div><br>
    <div class="form-group">
        <label for="livrer">Livré</label>
        <select name="livrer" class="form-control">
            <option value="oui" {{ $achat->livrer == 'oui' ? 'selected' : '' }}>Oui</option>
            <option value="non" {{ $achat->livrer == 'non' ? 'selected' : '' }}>Non</option>
        </select>
    </div><br>
    <center><button type="submit" style="background-color: #e3a538" class="btn btn">Modifier</button>
        <a style="background-color: rgb(224, 221, 221)"  href="{{route('achats.index')}}" class="btn btn">Annuler</a></center></form>
@endsection
