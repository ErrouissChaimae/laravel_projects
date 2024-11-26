@extends('layouts.app')

@section('title', 'Modifier commande')

@section('content')
<div class="container">
    <h1 style="color: #eb1b1b">Modifier la commande</h1>
    <form action="{{ route('commandes.update', $commande->id_commande) }}" method="POST" id="updateCommandeForm">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control shadow">
                @foreach($clients as $client)
                    <option value="{{ $client->id_client }}" {{ $commande->client_id == $client->id_client ? 'selected' : '' }}>{{ $client->nom }} {{ $client->prenom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="article_id">Article</label>
            <select name="article_id" id="article_id" class="form-control shadow">
                @foreach($articles as $article)
                    <option value="{{ $article->id_article }}" {{ $commande->article_id == $article->id_article ? 'selected' : '' }}>{{ $article->libele }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control shadow" value="{{ $commande->quantite }}">
        </div>
       
        <button type="submit" class="btn btn-danger" id="updateButton">Modifier</button>
        <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@include('includes.fot')

<!-- Include SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Submit form with SweetAlert confirmation
    document.getElementById('updateCommandeForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        const formData = new FormData(this);
        const url = this.getAttribute('action');

        // Send POST request to update the command
        fetch(url, {
            method: 'POST', // Change method to POST
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // If the update is successful, show SweetAlert success message and redirect to index page
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Modification enregistrée avec succès!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "{{ route('commandes.index') }}";
                });
            } else {
                // If there's an error, show SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur lors de la modification!',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
@endsection
