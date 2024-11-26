@extends('admin.layout')

@section('content')
<br><br><h1 class="text-center" style="color: #e36800">Ajouter une Réservation</h1>
<br>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('reservations.store') }}" method="POST" style="width: 70%;margin-left:12%; ">
    @csrf
    <div class="form-group">
        <label for="id_pers">Personne</label>
        <select name="id_pers" class="form-control">
            @foreach($membres as $membre)
                <option value="{{ $membre->personne->id_pers }}" {{ old('id_pers') == $membre->personne->id_pers ? 'selected' : '' }}>
                    {{ $membre->personne->cin}}
                </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="id_oeuvre">Oeuvre</label>
        <select name="id_oeuvre" class="form-control">
            @foreach($oeuvres as $oeuvre)
                <option value="{{ $oeuvre->id_livre }}" {{ old('id_oeuvre') == $oeuvre->id_livre ? 'selected' : '' }}>
                    {{ $oeuvre->titre }}
                </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="date_d_emprunt">Date d'Emprunt</label>
        <input type="date" name="date_d_emprunt" class="form-control" value="{{ old('date_d_emprunt') }}" required>
    </div><br>
    <div class="form-group">
        <label for="duree_d_emprunt">Durée d'emprunt (en jours)</label>
        <input type="number" name="duree_d_emprunt" id="duree_d_emprunt" class="form-control" value="{{ old('duree_d_emprunt', $reservation->duree_d_emprunt ?? 1) }}" required>
    </div>
    <br>
    <center><button type="submit" style="background-color: #e3a538" class="btn btn">Ajouter</button>
        <a style="background-color: rgb(224, 221, 221)"  href="{{route('reservations.index')}}" class="btn btn">Annuler</a></center>
    </form>
@endsection
