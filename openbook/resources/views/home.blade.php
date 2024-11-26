<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenBooks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Noto Serif', serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            background-color: #faf9f865;

            min-height: 100vh;
            padding-bottom: 60px; /* Height of the footer */
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
            color: #8d4f36;
        }

        .header-section {
            box-shadow: 0 0 10px rgba(221, 183, 133, 0.5); /* Taupe shadow */
            padding: 20px;
        }

        .header-content {
            color: rgb(151, 92, 3); /* Brun clair */
        }

        .header-content h1 {
            text-shadow: 0 2px 4px #e2c6a2; /* Taupe shadow */
        }

        .categories-section {
            width: 50%;
            background-color: rgba(255, 255, 255, 0.3); /* Sable */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 2px rgba(160, 80, 14, 0.404); /* Brun clair shadow */
            margin-top: -2%;
        }

        .categories-section p {
            color: rgb(107, 51, 4); /* Brun clair */
        }

        .categories-section .co {
            border-right: 1px solid rgba(107, 51, 4, 0.2); /* Brun clair */
        }



        .card {
            border: none;
            box-shadow: 0 4px 8px #e2c6a2;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            padding: 5px;
            margin: 5px;
            background-color: #ffffff57;
        }

        .c {
            border: none;
            box-shadow: 0 4px 8px #e2c6a2;
            border-radius: 10px;
            overflow: hidden;
            margin: 5px;
            text-align: center;
            max-height: 300px;
        }

        .card-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .c img {
            width: 100%;
            height: auto;
            max-width: 300px; /* Adjust max-width as needed */
            display: block;
        }

        .card-body {
            padding: 10px;
        }
        .cc .card-body {
            padding: 1px;
        }
        .cc img {
            width: 100%;
            height: auto;
            max-width: 300px; /* Adjust max-width as needed */
            display: block;
            min-height: 130px;
        }
        .cc {
            border: none;
            box-shadow: 0 4px 8px #e2c6a2;
            border-radius: 10px;
            margin: 5px;
            background: linear-gradient(to bottom, #fdebd7, #d8e2dc98);            max-height: 380px;
            text-align: left;
        }
        #message-box {
      display: none;
      color: #000000;
      background-color: #b4b4b45b;
      box-shadow: 0 4px 10px rgba(221, 183, 133, 0.5); /* Taupe shadow */
      padding: 20px 0;
      margin-top: -7%;

      border-radius: 5px;
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
        .equal-height {
    height: 100%;
}

       /* footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
}
/* Pour éviter que le footer ne chevauche le contenu *
main {
    margin-bottom: 100px; /* Ajustez cette valeur en fonction de la hauteur de votre footer *
}*/

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
    
    
   
    <header class="header-section" style="background-color: #FDEBD7;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="images/z1-removebg-preview.png" alt="Logo" width="100%">
                </div>
                <div class="col-md-8 text-center header-content">
                    <h1>La Bibliothèque qui vient à Vous...</h1>
                    <p>Explorez des mondes de savoir et d'aventure à travers notre collection de livres soigneusement sélectionnés.</p>
                    <h4 class="italic-text">Bienvenue sur Open Books en ligne, votre portail littéraire où la découverte rencontre la commodité! Explorez notre vaste collection de livres, réservez vos titres préférés et effectuez des achats en quelques clics. Plongez dans une expérience de lecture sans effort, où la passion pour les livres rencontre la simplicité de la technologie. Bienvenue dans notre bibliothèque en ligne, où chaque page vous ouvre une nouvelle porte vers l'aventure.</h4>
                    <a class="btn btn" href="/oeuvres"  type="submit" value="Voir plus" style="color: #e9d3b7;background-color: rgb(107, 51, 4);">Voir plus</a>
                <br><br></div>
            </div>
        </div>
    </header>

    <div class="container categories-section" id="categories-section">
        <div class="row">
            <div class="col-md-4 co">
                <div class="text-center">
                    <i class="fas fa-search fa-2x"></i>
                    <p>Explorez</p>
                </div>
            </div>
            <div class="col-md-4 co">
                <div class="text-center">
                    <i class="fas fa-university fa-2x"></i>
                    <p>Apprenez</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-chart-line fa-2x"></i>
                    <p>Grandissez</p>
                </div>
            </div>
        </div>
    </div><br>
    
    <div class="container mt-3" >
        <div id="message-box" class="alert alert-dark text-center">
          <h2> Vous ne trouvez pas ce que vous cherchez ? Contactez-nous :</h2>
          <h4> Contact :<a href="tel:+212 6088035540"><span style="color: #8f3410">+212 600000000
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
            </svg></span>
          </a></h4>
      
          <h4>Service Client : <a href="tel:+212 6088035540"><span style="color: #8f3410">+212 500000000
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
              <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
            </svg></span>
          </a></h4>
      
          <h4> Email :<a href=" mailto:chaimae.errouiss6@gmail.com"><span style="color: #8f3410">OpenBooks@gmail.com  
          <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-envelope-at-fill" width="20" height="20" viewBox="0 0 16 16">
            <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
            <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
          </svg></span>
          </a></h4>
      
          <h4>Adresse : <a href="https://www.google.com/maps/search/?api=1&query=NTIC2+SM,+Casablanca,+Maroc"><span style="color: #8f3410">OpenBooks, Casablanca, Maroc
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
              <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
            </svg></span></a></h4>
      
        </div>
    </div><br>
    <div class="container-fluid  text-center" style="width: 60%;
; border-radius: 8%; ">
        <br><h1 class="text-center" style="font-style: italic; color: #1d3557;font-size:3em;">Top Ventes du Mois</h1>
    <br>
        <div class="row">
            <div class="col-md-1"></div>
            @foreach($topVentes as $index => $oeuvre)
                <div class="col-md-{{ $index == 1 ? 4 : 3 }} card equal-height" style="background: linear-gradient(to bottom, #f1faee, #fdebd7);">
                    <div class="card-image">
                        <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="width: 100%;">
                    </div>
                    <div class="card-body" style="color: #3e1507; font-size: 2em; font-weight: ; font-style: italic;font-family:Bodoni, serif; /*/ Didot Caslon Bodoni*/">
                        <p class="card-text">{{ $oeuvre->titre }}</p>
                    </div>
                </div>
            @endforeach
            <div class="col-md-1"></div>
        </div><br>
    </div>
    <br>
    <div class="container-fluid" style="width:90%;;" >           
        <br><h1 class="text-center" style="font-style: italic; color: #1d3557;font-size:3em;">Tout Nos Oeuvres</h1>
    <br>

       <div class="row">
    @foreach($oeuvres as $oeuvre)
        <div class="col-md-3" >
            <div class="card cc">
                <div class="card-image">
                    <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="{{ $oeuvre->titre }}" style="max-height: 200px;">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-text"><span style="color: brown;">Titre:</span> {{ $oeuvre->titre }}</h4>
                    <h4 class="card-text"><span style="color: brown;">Auteur:</span> {{ $oeuvre->auteur }}</h4>
                    <h4 class="card-text"><span style="color: brown;">Prix:</span> {{ $oeuvre->prix }} Dhs</h4>
                    <center><a class="btn btn " style="background-color: #f1b361;" href="{{ route('hshow',['id_livre' => $oeuvre->id_livre]) }}">Details</a></center>
                </div>
            </div>
        </div>
    @endforeach               
</div>

        <br><br>
        
        
    </div>
</div><br>
<br>
<br><br>
<br>
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
<script>
    document.getElementById('aide-contact').addEventListener('click', function(event) {
        event.preventDefault();

        let categoriesSection = document.getElementById('categories-section');
        let messageBox = document.getElementById('message-box');

        if (categoriesSection.style.display === 'block') {
            categoriesSection.style.display = 'none';
            messageBox.style.display = 'block';
        } else {
            categoriesSection.style.display = 'block';
            messageBox.style.display = 'none';
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>