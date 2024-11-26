@extends('admin.layout')

@section('content')
<div class="container">
    <h1 style="color: #e36800">Modifier le Membre</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('membres.update', $membre->id_m) }}" method="POST" style="width: 70%; margin-left: 12%;">
        @csrf
        @method('PUT')

        <br>
        <div class="form-group">
            <label for="id_pers">Personne</label>
            <select name="id_pers" id="id_pers" class="form-control">
                @foreach($personnes as $personne)
                <option value="{{ $personne->id_pers }}" {{ $membre->id_pers == $personne->id_pers ? 'selected' : '' }}>
                    {{ $personne->cin }} 
                </option>
                @endforeach
            </select>
        </div>

        <br>
        <div class="form-group">
            <label for="mois_payer">Mois Payer</label>
            <div>
                <input type="radio" name="mois_payer" id="mois_payer_oui" value="1" {{ $membre->mois_payer ? 'checked' : '' }}>
                <label for="mois_payer_oui">Oui</label>
            </div>
            <div>
                <input type="radio" name="mois_payer" id="mois_payer_non" value="0" {{ !$membre->mois_payer ? 'checked' : '' }}>
                <label for="mois_payer_non">Non</label>
            </div>
        </div>

        <br>
        <div class="form-group">
            <label for="date_inscription">Date d'Inscription</label>
            <input type="date" name="date_inscription" id="date_inscription" class="form-control" value="{{ $membre->date_inscription }}" readonly>
        </div>

        <br>
        <center>
            <button type="submit" style="background-color: #e3a538" class="btn btn">Modifier</button>
            <a style="background-color: rgb(224, 221, 221)" href="{{ route('membres.index') }}" class="btn btn">Annuler</a>
        </center>
    </form>
</div>
@endsection
