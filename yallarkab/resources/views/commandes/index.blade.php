@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historique de mes Commandes :</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @foreach ($commandes as $commande)
        <div class="commande" style="justify-content:space-between;">
            <div class="commande-header">
                <h3>{{ $commande->ticket->ville_depart }}  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  color="#ff851b" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
                  </svg> {{ $commande->ticket->ville_arrivee }}</h3>
            </div>
            <div class="commande-body" >

                <div class="commande-photo">
                    <img src="{{ asset('images/' . $commande->ticket->autocar->photo) }}" width="100">
                </div>
                <br>
                <div class="commande-info">
                    <p><strong>Client :</strong> {{ $commande->client->prenom }} {{ $commande->client->name }} <span style="margin-left:5px;font-size:15px;"><strong>Commande N°:</strong> {{ $commande->id_commande }} </span> </p>

                    <p><strong>Heure de départ:</strong> {{ $commande->ticket->heure_depart }}</p>
                    <p><strong>Adultes:</strong> {{ $commande->adults }} <span style="margin-left:5px;font-size:15px;"><strong>Enfants:</strong> {{ $commande->children }} </p>
                    <p><strong>Quantité:</strong> {{ $commande->quantite }}</p>
                    <p><strong>Prix par ticket:</strong> {{ $commande->ticket->prix }} Dhs  <span style="margin-left:5px;font-size:15px;"><strong> Total:</strong> {{ $commande->prix_total }} Dhs </p>
                        <p><strong>QR : </strong><svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                            <path d="M2 2h2v2H2z"/>
                            <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                            <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                            <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                            <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                          </svg> </p>
                    <p style="float: right"><strong> Créer le :</strong> {{ $commande->created_at }} </p>
                    <br>
                    <div class="commande-actions">
                        <form action="{{ route('commandes.destroy', $commande->id_commande) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                           <strong> <button type="submit"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande?')"><i class="bi bi-trash"></i>
                            Supprimer</button></strong>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    @endforeach
    <br>
    <div class="pagination-links" style="margin-left: 100px; margin-top:-10px;">
        {{ $commandes->links('pagination::bootstrap-4') }}
    </div>

</div>
<br><br>
@include('layouts.footer')
@endsection
<style>
.commande {
    margin-bottom: 20px;
    padding: 14px;
    min-height: 150px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #ffffff;
    box-shadow: 2px 3px 8px  rgb(236, 236, 236);
   justify-content:space-between;

}

.commande-header {
    margin-bottom: 10px;
    padding: 10px;

}
.commande-header h3 {
    display: inline-block;
    position: relative;
    padding-left: 10px;
}

.commande-header h3::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 5px;
    height: 100%;
    background-color: #ff851b;
}

.commande-body {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.commande-info {
    flex-grow: 1;
    padding-left: 20px;
    margin-right: 10px;
}

.commande-info p {
    margin: 5px 0;
}

.commande-photo img {
    min-width:200px;
    border-radius: 5px;
}

.commande-actions {
    margin-top: 10px;
}

.commande-actions form button {
    color: #ffffff;
    background: #ff851b;
    border-radius: 10px;
    border: none;
    font-size: 18px;
    padding: 5px;
    margin: 5px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.commande-actions form button:hover {
    color: #ffffff; 
    background: #fcb06d;
    box-shadow: 1px 1px 1px gray;
}

.commande-actions form button i {
    margin-right: 5px;
}
.commande-actions a, .commande-actions form {
    display: inline-block;
    margin-right: 10px;
}
</style>