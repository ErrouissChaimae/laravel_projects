@extends('layouts.app2')
<style>
    .mini-hr {
           border: none; 
           height: 4px;
           background-color: #ff5e00; 
           width: 150px;
           margin: 0; 
           margin-top: -3px; 
           margin-bottom: 5px; 
           
       }
</style>
@section('content')
    <div class="container">
        <h1>Modifier un Autocar :</h1>
        <hr class="mini-hr">

        <form action="{{ route('autocars.update', $autocar->id_autocar) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ $autocar->nom }}" required>
            </div>
            <div class="form-group">
                <label for="nombre_de_places">Nombre de Places</label>
                <input type="number" name="nombre_de_places" class="form-control" value="{{ $autocar->nombre_de_places }}" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control">
                <img src="{{ asset('images/' . $autocar->photo) }}" alt="{{ $autocar->nom }}" width="100">
            </div>
            
            <button type="submit" class="btn btn-warning" style="color: rgb(255, 255, 255);background-color:orange; border-radius:50px; padding:10px 50px;">Modifier</button>
        </form>
    </div>
    @include('layouts.footer')
@endsection
