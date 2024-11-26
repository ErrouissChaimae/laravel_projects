@extends('layouts.app')

@section('title', 'Liste des Articles')

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
            margin-top: 10px;/* Ajouter un peu de bord arrondi */
            width: 300px; /* Ajustez la largeur selon vos besoins */
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
            background-color: rgba(77, 74, 74, 0.711); /* Noir transparent */
            color: rgb(189, 185, 185); /* Couleur du texte noire */
            border: none; /* Supprimer la bordure */
            padding: 0.5rem; /* Ajouter un peu de marge intérieure */
            border-radius: 0.25rem; /* Ajouter un peu de bord arrondi */
            width: 100px; /* Ajustez la largeur selon vos besoins */
            /* Ajouter un peu de marge à droite */
        }

       
       
    /* Autres styles CSS */
    
</style>





        <form class="container text-center mb-4" style="margin-top: -4%" action="{{ route('articles.rechercher') }}" method="POST">
            @csrf
            <div style="position: relative;">
                <input type="text" name="search" id="search" class="navbar-input" placeholder="libellé ou ID ">
                <button type="submit" class="btn btn" style="color: #ffffff; background-color:#EB1B1B">Rechercher</button>

            </div>
        </form>       

<div class="container">

<div class="row">

    <div class="md-8">
                <h2 style="color: #d62121">Liste des Articles:</h2></div>
    <div class="md-4" style="margin-left: 60%"><a class="btn btn-outline-dark" href="{{ route('articles.create') }}">Create New Article</a>
</div>

</div>

 <!-- Message sur le stock des articles -->
 @if($stockVide->isNotEmpty())
 <div class="alert alert-danger" role="alert">
     Stock des articles suivants est vide :
     <ul>
         @foreach($stockVide as $article)
         <li>{{ $article->id_article }}</li>
         @endforeach
     </ul>
 </div>
 @endif

 @if($stockPresqueVide->isNotEmpty())
 <div class="alert alert-warning" role="alert">
     Stock des articles suivants est presque vide :
     <ul>
         @foreach($stockPresqueVide as $article)
         <li>{{ $article->id_article }}</li>
         @endforeach
     </ul>
 </div>
 @endif



<table class="table  text-center border-dark ">
        <thead>
            <tr>
                <th>Id</th>    
                <th>Photo</th>
                <th>Libellé</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id_article }}</td>    
                 <td><img src="{{ asset('images/' . $article->photo) }}" alt="Article Image" width="50" height="50"></td>

                <td>{{ $article->libele }}</td>
                <td>{{ $article->prix }}</td>
                <td>{{ $article->quantite }}</td>
                <td>
                    <a href="{{ route('articles.edit',$article->id_article) }}" class="btn btn-success">Edit</a>
                    <form class="d-inline" action="{{ route('articles.destroy', $article->id_article) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-article">Delete</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <!-- Script to handle SweetAlert for delete button -->
    <script>
        // Add event listener to delete buttons
        document.querySelectorAll('.delete-article').forEach(button => {
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
