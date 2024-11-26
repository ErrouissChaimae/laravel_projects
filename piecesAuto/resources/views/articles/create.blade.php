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
    <br>
    <h1 style="color: #EB1B1B">Ajouter Article</h1>
    <br>
    <form id="articleForm" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="libele">Libele:</label>
            <input type="text" class="form-control shadow" id="libele" name="libele">
        </div>
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="text" class="form-control shadow" id="prix" name="prix">
        </div>
        <div class="form-group">
            <label for="quantite">Quantite:</label>
            <input type="text" class="form-control shadow" id="quantite" name="quantite">
        </div>
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control-file shadow" id="photo" name="photo" accept="image/*">
        </div>
        <button type="submit" class="btn btn-danger">Ajouter</button>
    </form>
</div>
@include('includes.fot')

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Écouter la soumission du formulaire
    document.getElementById('articleForm').addEventListener('submit', function (event) {
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
                    text: 'Article ajouté avec succès!',
                    icon: 'success',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Rediriger vers la page d'index
                    window.location.href = '/articles';
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
</body>
</html>
