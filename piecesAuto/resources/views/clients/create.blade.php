@section('title', 'Ajouter Clients')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Create Client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body>
    <div class="container  " style="width: 50%;">
        <br>
        <h1 style="color: #EB1B1B">Ajouter Clients</h1>
        <br>
        <form id="clientForm" action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control shadow" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prenom:</label>
                <input type="text" class="form-control shadow" id="prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control shadow" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input type="text" class="form-control shadow" id="telephone" name="telephone">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" class="form-control shadow" id="adresse" name="adresse">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control shadow" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-danger" >Ajouter</button>
            
        </form>
    </div>
    <br><br>

    @include('includes.fot')
</body>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Écouter la soumission du formulaire
    document.getElementById('clientForm').addEventListener('submit', function (event) {
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
                    text: 'Client ajouté avec succès!',
                    icon: 'success',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Rediriger vers une autre page ou effectuer une autre action si nécessaire
                    window.location.href = '{{ route("clients.index") }}';
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

</html>