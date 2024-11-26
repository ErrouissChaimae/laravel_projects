
@section('title', 'Modifier client')

@section('content')
<div class="container" style="width: 50%;">
    <br>
    <h1 style="color: #eb1b1b">Modifier Client</h1>
    <form id="updateCommandeForm" action="{{ route('clients.update', $client->id_client) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control shadow" id="nom" name="nom" value="{{ $client->nom }}">
        </div>
        <div class="form-group">
            <label for="prenom">Prenom:</label>
            <input type="text" class="form-control shadow" id="prenom" name="prenom" value="{{ $client->prenom }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control shadow" id="email" name="email" value="{{ $client->email }}">
        </div>
        <div class="form-group">
            <label for="telephone">Telephone:</label>
            <input type="text" class="form-control shadow" id="telephone" name="telephone" value="{{ $client->telephone }}">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" class="form-control shadow" id="adresse" name="adresse" value="{{ $client->adresse }}">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control shadow" id="password" name="password" value="{{ $client->password }}">
        </div>
        <button type="submit" class="btn btn-danger">Modifier</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<br><br>
@include('includes.fot')
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
                    window.location.href = "{{ route('clients.index') }}";
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
