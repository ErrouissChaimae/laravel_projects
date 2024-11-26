@extends('admin.layout')

@section('content')<br><br>
<h1 class="text-center" style="color: #e36800">Détails de la Réservation</h1><br>
<br>
<br>
<center>
<div class="card" style="width: 50%">
    <div class="card-header">
        Réservation #{{ $reservation->id_res }}
    </div>
    <div class="card-body">
        <center><p>
            @if($reservation->oeuvre->image)
                <img src="{{ asset('storage/' . $reservation->oeuvre->image) }}" alt="{{ $reservation->oeuvre->titre }}" style="width: 20%">
            @endif
        </p></center>
        <p><strong>Personne:</strong> {{$reservation->membre->personne->nom }} {{ $reservation->membre->personne->prenom }}</p>
        <p><strong>Oeuvre:</strong> {{ $reservation->oeuvre->titre }}</p>
        <p><strong>Date d'Emprunt:</strong> {{ $reservation->date_d_emprunt }}</p>
        <a href="{{ route('reservations.edit', $reservation->id_res) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('reservations.destroy', $reservation->id_res) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette réservation ?')">Supprimer</button>
                    </form>
                    <a style="background-color: rgb(224, 221, 221)"  href="{{route('reservations.index')}}" class="btn btn btn-sm">Retour</a></center>

    </div>
</div></center>
@endsection
