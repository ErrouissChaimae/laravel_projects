
@section('title', 'Modifier article')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="width: 50%">
        <br>
        <h1 style="color:#eb1b1b;">Modifier Article</h1>
        <form id="updateArticleForm" action="{{ route('articles.update', $article->id_article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="libele">Libele:</label>
                <input type="text" class="form-control shadow" id="libele" name="libele" value="{{ $article->libele }}">
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="text" class="form-control shadow" id="prix" name="prix" value="{{ $article->prix }}">
            </div>
            <div class="form-group">
                <label for="quantite">Quantite:</label>
                <input type="text" class="form-control shadow" id="quantite" name="quantite" value="{{ $article->quantite }}">
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-conktrol-file" id="photo" name="photo" accept="image/*">
            </div>
            <button type="submit" class="btn btn-danger">Modifier</button>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
    @include('includes.fot')
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Submit form with SweetAlert confirmation
    document.getElementById('updateArticleForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        const formData = new FormData(this);
        const url = this.getAttribute('action');

        // Send POST request to update the article
        fetch(url, {
            method: 'POST', // Change method to POST
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Erreur lors de la modification!');
            }
        })
        .then(data => {
            // If the update is successful, show SweetAlert success message and redirect to index page
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Modification enregistrée avec succès!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "{{ route('articles.index') }}";
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
            // Show SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Erreur lors de la modification!',
                text: error.message
            });
        });
    });
</script>
