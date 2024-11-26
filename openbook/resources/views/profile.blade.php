<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de {{ $user->nom }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Noto Serif', serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            min-height: 100vh;
            background-color: #f9f9f9;
            color: #333;
        }

        nav.navbar {
            background-color: #fdebd7;
        }

        .navbar-brand {
            color: #ddb785;
            font-size: 1.5em;
            font-weight: bold;
        }

        .nav-link {
            color: #d2b48c;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #b0885a;
        }

        .profile-section {
            margin-top: 20px;
            background-color: #e9edc983;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px #ccd5ae;
        }

        .profile-header {
           
            align-items: center;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 2em;
        }

        .profile-header .btn {
            background-color: #ccd5ae;
            color: #fff;
        }
        

        .profile-header .btn:hover {
            background-color: #b0885a;
        }

        .card {
            margin-top: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        footer {
            background: linear-gradient(to left, #e9edc9, #fdebd7);
            padding: 20px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .footer-content .logo img {
            width: 50px;
            height: auto;
            margin-bottom: 10px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .footer-links a {
            margin: 0 15px;
            text-decoration: none;
            color: #555;
        }

        .footer-links a:hover {
            color: #000;
        }

        .footer-bottom {
            font-size: 14px;
            color: #aaa;
        }

        .footer-bottom p {
            margin: 5px 0;
        }

        .table-bordered {
    border: 1px solid #ddd; /* Bordure extérieure de la table */
}
.table tbody tr:hover {
    background-color: #fafafa; /* Couleur de fond lors du survol */
}
.table th {
    background-color: #f9f9f9; /* Couleur de fond de l'en-tête de colonne */
    color: #333; /* Couleur du texte de l'en-tête de colonne */
    font-weight: bold; /* Style de police en gras pour l'en-tête de colonne */
}
.table td, .table th {
    padding: 8px; /* Espacement interne des cellules */
    border: 1px solid #ddd; /* Bordure des cellules */
}
.table {
    background-color: #fde6cd; /* Couleur de fond de la table */
    border-radius: 3%; /* Bordure arrondie */
    border-collapse: collapse; /* Fusionner les bordures des cellules */
    width: 100%; /* Largeur de la table */
    border: 1px solid #ddd; /* Bordure de la table */
}

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">OpenBooks</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="d-flex" method="GET" action="{{ route('searchp') }}">
                            <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Recherche" name="search">
                            <button class="btn btn-outline mt-sm" style="background-color: #ccd5ae;" type="submit">Rechercher</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #d2b48c;" href="/">Accueil</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/oeuvres">Œuvres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Mon profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('personne.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personne.login') }}">Se connecter</a>
                        </li>
                    @endauth
                    
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <div class="container profile-section" style="width: 50%">
        <div class="profile-header">
            <center><h1 class="">Profil de {{ $user->nom }} {{ $user->prenom }}</h1></center>
        </div>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Adresse:</strong> {{ $user->adresse }}</p>
        <p><strong>Numéro de téléphone:</strong> {{ $user->tel }}</p>
       <center> <a class="btn btn " style=" background-color: #588157;
            color: #fff;" href="{{ route('profile.edit', $user->id_pers) }}">Modifier Profil</a>
       </center>
    </div><br><br>
    <div class="container">
        <div class="card" style="background-color: #fde6cd5b">
            <div class="card-body">
                <h2 class="card-title">Mes Achats</h2>
                @if($achats->isEmpty())
                    <p class="card-text">Vous n'avez pas encore effectué d'achats.</p>
                @else
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Livre</th>
                                <th>Oeuvre</th>
                                <th>Quantité</th>
                                <th>Prix Total</th>
                                <th>Date d'achat</th>
                                <th>Livré</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($achats as $achat)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $achat->oeuvre->image) }}" alt="{{ $achat->oeuvre->titre }}" style="width: 100px; height: auto;"></td>
                                    <td>{{ $achat->oeuvre->titre }}</td>
                                    <td>{{ $achat->qts_achete }}</td>
                                    <td>{{ $achat->prix_ttc }} Dhs</td>
                                    <td>{{ $achat->date_achat }}</td>
                                    <td>{{ $achat->livrer }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
<br>
<br>
<br>
<br>
        @if($user->membre)
            <div class="card" style="background-color: #fde6cd">
                <div class="card-body">
                    <h2 class="card-title">Mes Réservations</h2>
                    @if($reservations->isEmpty())
                        <p class="card-text">Vous n'avez pas encore effectué de réservations.</p>
                    @else
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Livre</th>
                                    <th>Oeuvre</th>
                                    <th>Date d'emprunt</th>
                                    <th>Durée d'emprunt (jours)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td><img src="{{ asset('storage/' . $reservation->oeuvre->image) }}" alt="{{ $reservation->oeuvre->titre }}" style="width: 100px; height: auto;"></td>
                                        <td>{{ $reservation->oeuvre->titre }}</td>
                                        <td>{{ $reservation->date_d_emprunt }}</td>
                                        <td>{{ $reservation->duree_d_emprunt }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endif
    </div></div>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
    <footer>
        <div class="footer-content">
            <div class="logo">
                <img src="images/logoOp.png" alt="Logo">
            </div>
            <div class="footer-links">
                <a href="#">À propos</a>
                <a href="#">Contact</a>
                <a href="#">Termes & Conditions</a>
                <a href="#">Politique de Confidentialité</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 OpenBooks. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

