<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Œuvres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Noto Serif', serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav.navbar {
            background-color: #FDEBD7; /* Beige */
        }

        .navbar-brand {
            color: #ddb785; /* Taupe */
        }

        .nav-link {
            color: #D2B48C; /* Sable */
        }

        .nav-link:hover{
            color: #7a602c;
        }

        .search-bar {
            width: 60%;
        }

        .header-section {
            background-color: #FDEBD7; /* Beige */
            box-shadow: 0 0 10px rgba(221, 183, 133, 0.5); /* Taupe shadow */
            padding: 20px;
        }

        .header-content {
            color: rgb(151, 92, 3); /* Brun clair */
        }

        .header-content h1 {
            text-shadow: 0 2px 4px #e2c6a2; /* Taupe shadow */
        }

        .genre-container {
            max-width: 100%;
            overflow-x: auto;
            white-space: nowrap;
            padding: 20px;
            flex: 1; /* This makes the main content take up the remaining space */
        }

        .genre-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            overflow-x: auto; /* Horizontal scroll */
        }

        .genre-header {
            font-size: 24px;
            margin-right: 20px;
            color: rgb(107, 51, 4); /* Brun clair */
        }

        .card {
            margin-right: 20px;
            flex: 0 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: none;
            box-shadow: 0 4px 8px #e2c6a2;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            padding: 5px;
            margin: 5px;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            background-color: #2c3e50;
            border-radius: 8px 8px 0 0;
            color: #ffffff;
            font-size: 18px;
            padding: 10px 20px;
        }

        .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-body p {
            margin: 10px 0;
        }

        .card-body img {
            max-width: 100%;
            border-radius: 8px;
        }

        .bg1 {
            background-color: #d9dfdf;
            border-radius: 10px /* Beige */
        }

        .bg2 {
            background-color: #e2c6a24f;
            border-radius: 10px /* Beige */
            /* Light Taupe */
        }

        .bg3 {
            background-color: #e2f2c1;
            border-radius: 10px /* Beige */
            /* Taupe */
        }

        footer {
            background: linear-gradient(right,#e2f2c1, #FDEBD7);
            padding: 20px;
            text-align: center;
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/images/logoOp.png" alt="Logo" width="40" height="40" style="margin-top: -8%" class="d-inline-block align-text-top">
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
    
    <header class="header-section" style="background-color: #FDEBD7;">
        <div class="container" style="width: 70%">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="/images/z1-removebg-preview.png" alt="Logo" width="70%" style="margin-top: -10%">
                </div>
                <div class="col-md-8 text-center header-content">
                    <h1>Trouvez votre Livre Préfèrer...</h1>
                    
                    <form class="d-flex search-bar ms-auto" action="{{ route('search') }}" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Recherche" aria-label="Recherche">
                        <button class="btn btn-outline" type="submit" style="background-color: #7a602c;color:#fff;">Rechercher</button>
                    </form>
                <br><br></div>
            </div>
        </div>
    </header>

    <!-- Genre Buttons -->
    <div class="container my-3 text-center">
        @foreach($genres as $genre)
            <button type="button" class="btn btn m-1 genre-filter" style="background-color: #842d33; color: rgb(255, 255, 255);" data-genre="{{ $genre }}">{{ $genre->genre }}</button>
        @endforeach
    </div>
    

    <!-- Main Content -->
    <main id="oeuvre-container" class="container genre-container" style="width: 85%">
        @foreach($genres as $index => $genre)
            <h1 class="genre-header">{{ $genre->genre }}</h1>
            <div class="genre-row bg{{ ($index % 3) + 1 }}">
                @foreach($oeuvres as $oeuvre)
                    @if($oeuvre->genre === $genre->genre)
                        <div class="card cc">
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="max-height: 100px">
                            </div>
                            <div class="card-body">
                                <h4 class="card-text"><span style="color: brown">Titre: {{ $oeuvre->titre }}</span></h4>
                                <h4 class="card-text"><span style="color: brown">Auteur: {{ $oeuvre->auteur }}</span></h4>
                                <h4 class="card-text"><span style="color: brown">Prix: {{ $oeuvre->prix }} Dhs</span></h4>
                                <a class="btn btn" style="background-color: rgb(143, 72, 15)" href="{{route('hshow',['id_livre' => $oeuvre->id_livre])}}">Details</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </main>

    <footer>
        <div class="footer-content">
            <div class="logo">
                <img src="/images/logoOp.png" alt="Logo">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.genre-filter').on('click', function() {
                var genre = $(this).data('genre');
                $.ajax({
                    url: '{{ route('filter.genre') }}',
                    method: 'GET',
                    data: { genre: genre },
                    success: function(response) {
                        $('#oeuvre-container').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
