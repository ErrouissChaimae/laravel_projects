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
    <h2 style="margin-top:-25px;">Modifier l'utilisateur</h2>
    <hr class="mini-hr">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('admin.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="tel">Téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="{{ $user->tel }}">
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
        </div>
        <div class="form-group">
            <label for="cin">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" value="{{ $user->cin }}">
        </div>
        <button type="submit" class="btn btn-warning" style="color: rgb(255, 255, 255);background-color:orange; border-radius:50px; padding:10px 50px;">Mettre à jour</button>
    </form>
</div>
<br><br>
@include('layouts.footer')

@endsection

           
