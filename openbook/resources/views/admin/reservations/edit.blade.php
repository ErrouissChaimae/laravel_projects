@extends('admin.layout')

@section('content')
<br><br><h1 class="text-center" style="color: #e36800">Modifier la Réservation</h1>
<br>
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

<form action="{{ route('reservations.update', $reservation->id_res) }}" method="POST" style="width: 70%;margin-left:10%; ">
    @csrf
    @method('PUT')
    <div class="form-group" >
        <label for="id_pers">Membre</label>
        <select name="id_pers" class="form-control">
            @foreach($membres as $membre)
                <option value="{{ $membre->id_pers }}" {{ $reservation->id_pers == $membre->id_pers ? 'selected' : '' }}>
                    {{ $membre->personne->cin }} 
                </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="id_oeuvre">Oeuvre</label>
        <select name="id_oeuvre" class="form-control">
            @foreach($oeuvres as $oeuvre)
                <option value="{{ $oeuvre->id_livre }}" {{ $reservation->id_oeuvre == $oeuvre->id_livre ? 'selected' : '' }}>
                    {{ $oeuvre->titre }}
                </option>
            @endforeach
        </select>
    </div><br>
    <div class="form-group">
        <label for="date_d_emprunt">Date d'Emprunt</label>
        <input type="date" name="date_d_emprunt" class="form-control" value="{{ $reservation->date_d_emprunt }}" required>
    </div><br>
    <div class="form-group">
        <label for="duree_d_emprunt">Durée d'Emprunt</label>
        <input type="number" name="duree_d_emprunt" class="form-control" value="{{ $reservation->duree_d_emprunt }}" required>
    </div><br>
    <center><button type="submit" class="btn btn-primary">Modifier</button>
    <a style="background-color: rgb(224, 221, 221)"  href="{{route('reservations.index')}}" class="btn btn">Annuler</a></center>

</form>
@endsection
