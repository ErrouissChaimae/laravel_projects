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
        <h1>Ajouter un Autocar :</h1>
        <hr class="mini-hr">

        <form action="{{ route('autocars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre_de_places">Nombre de Places</label>
                <input type="number" name="nombre_de_places" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control" required>
            </div>

            <button type="submit" class="btn btn" style="color: rgb(255, 255, 255);background-color:rgb(255, 123, 0); border-radius:50px;">Ajouter</button>
        </form>
    </div>
    @include('layouts.footer')
@endsection
