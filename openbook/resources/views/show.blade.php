<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'œuvre</title>
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
            padding-bottom: 60px;
            background-color: #f9f9f9;
        }

        nav.navbar {
            background-color: #FDEBD7;
        }

        .navbar-brand {
            color: #ddb785;
            font-size: 1.5em;
            font-weight: bold;
        }

        .nav-link {
            color: #D2B48C;
            font-weight: bold;
        }

        .oeuvre-details {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .oeuvre-details img {
            width: 100%;
            height: auto;
            max-width: 100%;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .oeuvre-details h1, .oeuvre-details p {
            color: #444;
        }

        footer.footer-section {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            color: #D2B48C;
            text-align: center;
            padding: 20px 0;
            background: linear-gradient(to left, #e9edc9, #fdebd7);
        }

        .rating {
            color: #FFD700;
        }

        .hidden-form {
            display: none;
            margin-top: 20px;
        }

        .scrollable-row {
            overflow-x: auto;
            white-space: nowrap;
        }

        .scrollable-row .row {
            display: inline-flex;
            flex-wrap: nowrap;
        }
        .card{
            min-height: 280px;
            max-height: 280px;
        }
        .card img{
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logoOp.png" alt="Logo" width="40" height="40" style="margin-top: -8%" class="d-inline-block align-text-top">
                OpenBooks
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #D2B48C;" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/oeuvres">Œuvres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="aide-contact">Contact</a>
                    </li>
                    @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('profile.show')}}">Mon profil</a></li>
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

    <div class="container oeuvre-details" style="width:60%;">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="width: 100%; height: 250px;">
                <div class="rating text-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
            </div>
            <div class="col-md-8">
                <h1>{{ $oeuvre->titre }}</h1>
                <p><strong>Genre:</strong> {{ $oeuvre->genre }}</p>
                <p><strong>Auteur:</strong> {{ $oeuvre->auteur }}</p>
                <p><strong>Date de parution:</strong> {{ $oeuvre->date_parution }}</p>
                <p><strong>Résumé:</strong> {{ $oeuvre->resumer }}</p>
                <p><strong>Prix:</strong> {{ $oeuvre->prix }} Dhs</p>
                
                @auth
                    @php
                        $membre = Auth::user()->membre;
                        $prixAvecRemise = $membre ? $oeuvre->prix * 0.85 : $oeuvre->prix;
                    @endphp
                    @if($membre)
                        <p><strong>Prix avec remise:</strong> {{ $prixAvecRemise }} Dhs</p>
                        <a type="submit" href="#" class="btn btn acheter-btn" style="background-color: #e5989b;">Acheter</a>
                        <a type="submit" href="#" class="btn btn reserver-btn" style="background-color:#83c5be">Réserver</a>
                    @else
                        <a type="submit" href="#" class="btn btn acheter-btn" style="background-color: #e5989b;">Acheter</a>
                    @endif
                @else
                    <p>Vous devez être connecté pour consulter les détails de cet objet.</p>
                @endauth

                <div class="hidden-form achat-form">
                    <form action="{{ route('acheter', ['id_livre' => $oeuvre->id_livre]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="qts_achete" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="qts_achete" name="qts_achete" value="1" min="1" max="10">
                        </div>
                        <button type="submit" class="btn btn-success">Acheter</button>
                    </form>
                </div>

                <div class="hidden-form reservation-form">
                    <form action="{{ route('reserve', ['id_oeuvre' => $oeuvre->id_livre]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date_d_emprunt" class="form-label">Date d'emprunt</label>
                            <input type="date" class="form-control" id="date_d_emprunt" name="date_d_emprunt" required>
                        </div>
                        <div class="mb-3">
                            <label for="duree_d_emprunt" class="form-label">Durée d'emprunt (jours)</label>
                            <input type="number" class="form-control" id="duree_d_emprunt" name="duree_d_emprunt" value="7" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Réserver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Carrousel pour les livres du même genre -->
    <h2>Livres du même genre</h2>
    <div class="scrollable-row">
        <div class="row" style="width: 60%;background-color:#dfd1bf;">
            @foreach($sameGenreWorks as $oeuvre)
                <div class="col-md-3">
                    <div class="card cc">
                        <div class="card-image">
                            <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="max-height: 100px">
                        </div>
                        <div class="card-body">
                            <h4 class="card-text"><span style="color: brown">Titre: {{ $oeuvre->titre }}</span></h4>
                            <h4 class="card-text"><span style="color: brown">Auteur: {{ $oeuvre->auteur }}</span></h4>
                            <h4 class="card-text"><span style="color: brown">Prix: {{ $oeuvre->prix }} Dhs</span></h4>
                            <a class="btn btn" style="background-color: rgb(143, 72, 15)" href="{{ route('hshow', ['id_livre' => $oeuvre->id_livre]) }}">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Carrousel pour les livres du même auteur -->
    <h2>Livres du même auteur</h2>
    <div class="scrollable-row" >
        <div class="row" style="width: 60%;background-color:#dfd1bf;">
            @foreach($sameAuthorWorks as $oeuvre)
            <div class="col-md-3">
                <div class="card cc">
                    <div class="card-image">
                        <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="max-height: 100px">
                    </div>
                    <div class="card-body">
                        <h4 class="card-text"><span style="color: brown">Titre: {{ $oeuvre->titre }}</span></h4>
                        <h4 class="card-text"><span style="color: brown">Auteur: {{ $oeuvre->auteur }}</span></h4>
                        <h4 class="card-text"><span style="color: brown">Prix: {{ $oeuvre->prix }} Dhs</span></h4>
                        <a class="btn btn" style="background-color: rgb(143, 72, 15)" href="{{ route('hshow', ['id_livre' => $oeuvre->id_livre]) }}">Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>© 2024 OpenBooks</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.acheter-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.querySelector('.achat-form').style.display = 'block';
                    document.querySelector('.reservation-form').style.display = 'none';
                });
            });

            document.querySelectorAll('.reserver-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.querySelector('.reservation-form').style.display = 'block';
                    document.querySelector('.achat-form').style.display = 'none';
                });
            });
        });
    </script>
</body>
</html>

