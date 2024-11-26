
@section('title', 'Nouvelle commande')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>
<body>
<div class="container" style="width: 50%">
    <br><br>
    <h1 style="color: #eb1b1b">Nouvelle commande</h1>
    <form id="cmdForm" action="{{ route('commandes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control shadow">
                @foreach($clients as $client)
                    <option value="{{ $client->id_client }}">{{ $client->email }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="article_id">Article</label>
            <select name="article_id" id="article_id" class="form-control shadow">
                @foreach($articles as $article)
                    <option value="{{ $article->id_article }}" data-prix="{{ $article->prix }}">{{ $article->libele }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control shadow">
        </div>
        
        <button type="submit" class="btn btn-danger">Enregistrer</button>
    </form>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#article_id, #quantite').change(function() {
                var article_id = $('#article_id').val();
                var quantite = $('#quantite').val();
                var prix_unitaire = $('option:selected', '#article_id').data('prix');
                var prix_total = prix_unitaire * quantite;
                $('#prix_unitaire').val(prix_unitaire);
                $('#prix_total').val(prix_total);
            });
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Écouter la soumission du formulaire
    document.getElementById('cmdForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Empêcher la soumission du formulaire par défaut

        // Soumettre le formulaire via AJAX
        var formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Afficher une SweetAlert de succès
                Swal.fire({
                    title: 'Succès',
                    text: 'Commande ajoutée avec succès!',
                    icon: 'success',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Rediriger vers la page d'index
                    window.location.href = '{{ route("commandes.index") }}';
                });
            } else {
                // Afficher une SweetAlert d'erreur
                Swal.fire({
                    title: 'Erreur',
                    text: data.message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            // Afficher une SweetAlert d'erreur
            Swal.fire({
                title: 'Erreur',
                text: 'Une erreur s\'est produite.',
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
            console.error('Error:', error);
        });
    });
</script>
@include('includes.fot')
