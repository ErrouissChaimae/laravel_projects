@extends('admin.layout')

@section('content')
<div class="container">
    <h1 style="color: #e36800">Modifier l'Emprunt</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('emprunts.update', $emprunt->id_emprunt) }}" method="POST" style="width: 70%;margin-left:12%; ">
        @csrf
        @method('PUT')

       <br> <div class="form-group">
            <label for="id_membre">Membre</label>
            <select name="id_membre" class="form-control">
                @foreach($membres as $membre)
                <option value="{{ $membre->id_m }}" {{ $emprunt->id_membre == $membre->id_m ? 'selected' : '' }}>
                    {{ $membre->nom }} {{ $membre->prenom }}
                </option>
                @endforeach
            </select>
        </div>

       <br> <div class="form-group">
            <label for="id_livre">Oeuvre</label>
            <select name="id_livre" class="form-control">
                @foreach($oeuvres as $oeuvre)
                <option value="{{ $oeuvre->id_livre }}" {{ $emprunt->id_livre == $oeuvre->id_livre ? 'selected' : '' }}>
                    {{ $oeuvre->titre }}
                </option>
                @endforeach
            </select>
        </div>

        <br> <div class="form-group">
            <label for="date_debut">Date de Début</label>
            <input type="date" name="date_debut" class="form-control" value="{{ $emprunt->date_debut }}" required>
        </div>

        <br><div class="form-group">
            <label for="date_fin">Date de Fin</label>
            <input type="date" name="date_fin" class="form-control" value="{{ $emprunt->date_fin }}" required>
        </div>

       <br> <div class="form-group">
            <label for="rendu">Rendu</label>
            <select name="rendu" class="form-control">
                <option value="oui" {{ $emprunt->rendu == 'oui' ? 'selected' : '' }}>Oui</option>
                <option value="non" {{ $emprunt->rendu == 'non' ? 'selected' : '' }}>Non</option>
            </select>
        </div>
<br>
        <center><button type="submit" style="background-color: #e3a538" class="btn btn">Ajouter</button>
            <a style="background-color: rgb(224, 221, 221)"  href="{{route('emprunts.index')}}" class="btn btn">Annuler</a></center></form>    </form>
</div>
@endsection
