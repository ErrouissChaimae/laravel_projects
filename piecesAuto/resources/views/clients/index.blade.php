@extends('layouts.app')

@section('title', 'Liste des Clients')

@section('content')

<div style="width: 100%;">
    <style>
        /* Style pour l'input */
        .navbar {
            background-color: #000000;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px;
        }

        .mb-4 {
            padding-top: 10px;
        }

        .navbar-input {
            background-color: rgba(216, 214, 214); /* Noir transparent */
            color: black; /* Couleur du texte noire */
            border: none; /* Supprimer la bordure */
            padding: 0.5rem; /* Ajouter un peu de marge intérieure */
            border-radius: 0.25rem; 
            margin-top: 10px;
            width: 300px; /* Ajustez la largeur selon vos besoins */
        }

        /* Style pour l'icône de recherche */
  


        .navbar-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 120px;
            margin-left: 20px;
            float: left;
        }

    </style>



    
        

             

            <form class="container text-center mb-4" style="margin-top: -4%" action="{{ route('clients.rechercher') }}" method="GET">
                @csrf
                    <input type="text" name="search" id="search" class="navbar-input" placeholder="rechercher">
                    <button type="submit" class="btn btn" style="color: #ffffff; background-color:#EB1B1B">Rechercher</button>
            </form>



    <div class="container">
        <div class="row">
            <div class="md-8">
        <h1 class="mt-4" style="color: #d62121">liste des Clients:</h1>
            </div>
            <div class="md-4" style="margin-left: 84%;margin-top:-4%">
        <a class="btn btn-outline-dark" href="{{ route('clients.create') }}">Create New Client</a>
            </div>
        </div>

        <table class="table ">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
<tr>
    <td>{{ $client->id_client }}</td>
    <td>{{ $client->nom }}</td>
    <td>{{ $client->prenom }}</td>
    <td>{{ $client->email }}</td>
    <td>{{ $client->telephone }}</td>
    <td>{{ $client->adresse }}</td>
    <td>
        <a href="{{ route('clients.edit', $client->id_client) }}" class="btn btn-success">Edit</a>
        <form class="d-inline" action="{{ route('clients.destroy', $client->id_client) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger delete-client">Delete</button>
        </form>
    </td>
</tr>
@endforeach

            </tbody>
        </table>
    </div>
    
    <!-- Include SweetAlert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <!-- Script to handle SweetAlert for delete button -->
    <script>
        // Add event listener to delete buttons
        document.querySelectorAll('.delete-client').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default form submission
                const form = this.parentElement;
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
