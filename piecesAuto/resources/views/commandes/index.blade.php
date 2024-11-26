@extends('layouts.app')

@section('title', 'Liste des Commandes')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Ajout de Font Awesome pour l'icône de l'œil -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            margin-top: 10px;/* Ajouter un peu de bord arrondi */
            width: 200px; /* Ajustez la largeur selon vos besoins */
        }

        /* Style pour l'icône de recherche */
        .navbar-search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        /* Style pour le select */
        .form-select {
            background-color: rgba(216, 214, 214); /* Noir transparent */
            color: rgb(0, 0, 0); /* Couleur du texte noire */
            border: none; /* Supprimer la bordure */
            padding: 0.5rem; /* Ajouter un peu de marge intérieure */
            border-radius: 0.25rem; /* Ajouter un peu de bord arrondi */
            width: 100px; /* Ajustez la largeur selon vos besoins */
            /* Ajouter un peu de marge à droite */
        }


        .navbar-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 120px;
            margin-left: 20px;
            float: left;
        }
        .table{
            border: #000000
        }

    </style>



        
            <form class="container text-center mb-4" style="margin-top: -4%" action="{{ route('commandes.rechercher') }}" method="POST">
                @csrf
                <div style="position: relative;">
                    <input type="text" name="search" id="search" class="navbar-input" placeholder="Rechercher ">
                    <select name="type" id="type" class="form-select" >
                        <option value="client">Client</option>
                        <option value="article">Article</option>
                        <option value="id_commande">ID de commande</option>
                    </select>
                    
                    <button type="submit" class="btn btn" style="color: #ffffff; background-color:#EB1B1B; margin-top: -0.5rem;">Rechercher</button>

                </div></form>


    <br>
    <div class="container">
        <div class="row">
            <div class="md-8">
        <h1 style="color: #d62121">Liste des commandes:</h1>
        </div>
        <div class="md-4" style="margin-left: 83%;margin-top:-4%">
        <a class="btn btn-outline-dark" href="{{ route('commandes.create') }}">Nouvelle commande</a>
        </div>
    </div>
    @if (!empty($commandesEnRetard))
    <div class="alert alert-danger" role="alert">
        Les commandes suivantes sont en retard :
        <ul>
            @foreach ($commandesEnRetard as $commande)
                <li>Commande ID: {{ $commande->id_commande }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <table class="table  text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Client</th>
                    <th scope="col">Article</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Prix h.t</th>
                    <th scope="col">Prix t.t.c</th>
                    <th scope="col">DateTime </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                <tr>
                    <th scope="row">{{ $commande->id_commande }}</th>
                    <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                    <td>{{ $commande->article->libele }}</td>
                    <td>{{ $commande->quantite }}</td>
                    <td>{{ $commande->prix_unitaire }}</td>
                    <td>{{ $commande->prix_total }}</td>
                    <td>{{ $commande->prix_ttc }}</td>
                    <td>{{ $commande->date_commande }}</td>
                    <td>
                        
                        <a href="{{ route('commandes.show', $commande->id_commande) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('commandes.edit', $commande->id_commande) }}" class="btn btn-success">Éditer</a>
                        <!-- Utilisez SweetAlert pour la confirmation de la suppression -->
                        <form action="{{ route('commandes.destroy', $commande->id_commande) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-commande">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
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
