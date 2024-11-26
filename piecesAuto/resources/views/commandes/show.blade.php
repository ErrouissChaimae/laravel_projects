@extends('layouts.app')

@section('title', 'Details commande')

@section('content')
<div class="container">
    <h1 style="color: #d62121;margin-top:-4%;">Détails de la commande</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <br>
                <div class="col-sm-6">            
                    <img src="{{ asset('images/' . $commande->article->photo) }}" width="75%" alt="Article Image" class="img-fluid">
                </div>
                <div class="col-sm-6">
                    <p><strong>ID de la commande:</strong> {{ $commande->id_commande }}</p>
                    <p><strong>Client:</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}</p>
                    <p><strong>Article:</strong> {{ $commande->article->libele }}</p>
                    <p><strong>Quantité:</strong> {{ $commande->quantite }}</p>
                    <p><strong>Prix unitaire:</strong> {{ $commande->prix_unitaire }}</p>
                    <p><strong>Prix h.t:</strong> {{ $commande->prix_total }}</p>
                    <p><strong>Prix t.t.c:</strong> {{ $commande->prix_ttc }}</p>
                    <p><strong>Adresse de livraison:</strong> {{ $commande->client->adresse }}</p>
                    <p><strong>Téléphone:</strong> {{ $commande->client->telephone }}</p>
                    <p><strong>Adresse email:</strong> {{ $commande->client->email }}</p>
                    <p><strong>Date et heure de commande:</strong> {{ $commande->date_commande }}</p>

                    <div class="mt-3">
                        <a href="{{ route('commandes.edit', $commande->id_commande) }}" class="btn btn-success mr-2">Éditer</a>
                        <form action="{{ route('commandes.destroy', $commande->id_commande) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-commande">Supprimer</button>
                        </form>
                        <a href="{{ route('commandes.index') }}" class="btn btn-warning">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.fot')

<!-- Include SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Script to handle delete confirmation with SweetAlert -->
<script>
    // Add event listener to delete buttons
    const deleteButtons = document.querySelectorAll('.delete-commande');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default form submission
            const form = this.parentElement;
            const url = form.getAttribute('action');

            // Use SweetAlert for confirmation
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: 'Cette action est irréversible!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
