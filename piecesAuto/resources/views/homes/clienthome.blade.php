<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Votre Site de Pièces Automobiles</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #111;
      color: #fff;
    }
    .navbar {
      background-color: #000;
    }
    .navbar-brand {
      color: #fff;
      font-size: 24px;
    }
    .navbar-toggler-icon {
      background-color: #fff;
    }
    .nav-link {
      color: #fff !important;
    }
    .navbar-nav {
      margin-right: auto;
    }
    #message-box {
      display: none;
      color: #fff;
      background-color: #000;
      padding: 20px;
      margin-top: 20px;
      border-radius: 5px;
    }
    .faq-item {
      margin-top: 50px;
    }

    .faq-question {
      cursor: pointer;
      margin-bottom: 20px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
    }

    .faq-answer {
      display: none;
      padding-left: 20px;
      border-left: 2px solid red;
      margin-bottom: 20px;
    }

    footer {
      background-color: #333;
      padding: 20px;
      border-radius: 10px;
      color: #ccc;
    }

    footer a {
      color: #ccc;
    }

    footer a:hover {
    color: red;
  }
  .navbar-nav .nav-link:hover {
    color: red !important; /* Couleur du texte au survol */
  }

  /* Styles pour le hover dans le footer */
  .ff a:hover {
    color: red; /* Couleur du texte au survol */
  }
  
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="images/logo4.jpg" alt="Logo" width="80" height="50" class="d-inline-block align-top">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" style="margin-left: 60%" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#faq-section">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="aide-contact">Aide et Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


<div class="container mt-5">
  <div id="message-box" class="alert alert-dark">
    <h2> Vous ne trouvez pas ce que vous cherchez ? Contactez-nous :</h2>
    <p> Contact :<a href="tel:+212570180988"><span style="color: rgba(255, 0, 0, 0.89)">+212570180988
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
      </svg></span>
    </a></p>

    <p>Service Client : <a href="tel:+212770180988"><span style="color: rgba(255, 0, 0, 0.89)">+212770180988
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
        <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
      </svg></span>
    </a></p>

    <p> Email :<a href=" mailto:ghizlanazzab@gmail.com"><span style="color: rgba(255, 0, 0, 0.89)">pieceauto@gmail.com  
    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-envelope-at-fill" width="20" height="20" viewBox="0 0 16 16">
      <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
      <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
    </svg></span>
    </a></p>

    <p>Adresse : <a href="https://www.google.com/maps/search/?api=1&query=NTIC2+SM,+Casablanca,+Maroc"><span style="color: rgba(255, 0, 0, 0.89)">NTIC2 SM, Casablanca, Maroc
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
      </svg></span></a></p>

  </div>

  <div class="row">
    <div class="col-lg-6" style="margin-top: 2%"><br>
      <video controls autoplay muted loop width="100%">
        <source src="autoPiece.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la lecture de vidéos HTML5.
      </video>
    </div>
    <div class="col-lg-6">
      <h1>Bienvenue sur Notre Site de Pièces Automobiles</h1>
      <p>Nous sommes votre destination en ligne ultime pour toutes vos pièces automobiles. Que vous soyez un passionné de bricolage automobile ou un professionnel de l'industrie, notre vaste sélection de pièces de haute qualité répondra à tous vos besoins.</p>
      <p>Chez pieces Automobiles, nous comprenons l'importance de la fiabilité et de la performance de votre véhicule. C'est pourquoi nous nous efforçons de vous offrir une gamme complète de pièces provenant des meilleurs fabricants, garantissant une qualité inégalée et une compatibilité parfaite avec votre voiture.</p>
      <a href="{{ route('login') }}" class="btn btn" style="background-color: red; color: #fff;">Découvrez nos produits</a>
    </div>
  </div>
  <script>
    function toggleAnswer(answerId) {
      var answer = document.getElementById(answerId);
      if (answer.style.display === "block") {
        answer.style.display = "none";
      } else {
        answer.style.display = "block";
      }
    }
  </script>
  <script>
    document.getElementById('aide-contact').addEventListener('click', function(event) {
event.preventDefault(); 

var messageBox = document.getElementById('message-box');
messageBox.style.display = 'block';
});</script>
</div>
<br>
<div class="container mt-5">
  <h2 class="text-center">Top des meilleures marques de véhicules:</h2><br>
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/proche.png" alt="Logo Porsche" class="img-fluid" height="150" width="150">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/audii.png" alt="Logo Audi" class="img-fluid" height="150" width="150">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/toyota.png" alt="Logo Toyota" class="img-fluid" height="150" width="150">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/dacia.png" alt="Logo Dacia" class="img-fluid" width="85%" style="margin-top: -50px">
    </div>
  </div>
  <hr style="background-color: #53525256">
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/renault.png" alt="Logo Renault" class="img-fluid" height="150" width="150">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/benz.png" alt="Logo Benz" class="img-fluid" height="150" width="150">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/volsvagen.png" alt="Logo Volkswagen" class="img-fluid" height="150" width="150">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img src="images/ctr.png" alt="Logo Citroën" class="img-fluid" height="150" width="180" style="margin-left: 10%; margin-top: 8%;">
    </div>
  </div>
</div><br>
<div id="faq-section" class="faq-item container mt-5" style="background-color: #111; border: 1px solid #ffffff; padding: 20px; border-radius: 10px;">
  <h2 class="text-center mb-4" style="color: #fff;">Besoin d'aide ? Consultez nos questions fréquemment posées :</h2>
  <div class="accordion" id="faqAccordion">
    <div class="card">
      <div class="card-header" id="headingOne" style="background-color: #333;">
        <h3 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color: #fff;">
            Quelle est la politique de retour de votre site en cas de pièce défectueuse ou incompatible ?
          </button>
        </h3>
      </div>

      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
        <div class="card-body" style="color: #fff; background-color: #222; padding: 10px 20px; border-radius: 5px; border-left: 5px solid red;">
          <p>Nous avons une politique de retour flexible qui vous permet de retourner les pièces défectueuses ou incompatibles dans les 7 jours suivant l'achat. Veuillez consulter notre page de politique de retour pour plus de détails.</p>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo" style="background-color: #333;">
        <h3 class="mb-0">
          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: #fff;">
            Comment puis-je suivre ma commande après l'avoir passée ?
          </button>
        </h3>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
        <div class="card-body" style="color: #fff; background-color: #222; padding: 10px 20px; border-radius: 5px; border-left: 5px solid red;">
          <p>Une fois votre commande expédiée, vous recevrez un e-mail de confirmation contenant un lien de suivi. Vous pouvez également vous connecter à votre compte sur notre site web pour suivre l'état de votre commande.</p>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree" style="background-color: #333;">
        <h3 class="mb-0">
          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color: #fff;">
            Vos pièces sont-elles neuves ou d'occasion ?
          </button>
        </h3>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
        <div class="card-body" style="color: #fff; background-color: #222; padding: 10px 20px; border-radius: 5px; border-left: 5px solid red;">
          <p>Nous vendons principalement des pièces neuves, mais nous proposons également une sélection de pièces d'occasion soigneusement inspectées et testées pour garantir leur qualité.</p>
        </div>
      </div>
    </div>
  </div>
</div>


<br>
<footer class="container-fluid mt-5 mb-3 f" style="background-color:#000;padding:2%; border-radius: 10px;">
  <div class="row">
    <div class="col-md-4">
      <h4 style="color: #941111;">À propos de Nous</h4>
      <p style="color: #ccccccce;">Nous sommes votre source ultime pour toutes vos pièces automobiles. Avec une vaste sélection de pièces de haute qualité provenant des meilleurs fabricants, nous sommes là pour vous aider à garder votre véhicule en parfait état.</p>
    </div>
    <div class="col-md-4">
      <h4 style="color: #941111;">Nos Services</h4>
      <ul>
        <li style="color: #ccccccce;">Vente de pièces automobiles</li>
        <li style="color: #ccccccce;">Assistance à la clientèle</li>
        <li style="color: #ccccccce;">Politique de retour flexible</li>
        <li style="color: #ccccccce;">Livraison rapide</li>
      </ul>
    </div>
    <div class="col-md-4">
      <h4 style="color: #941111;">Contactez-Nous</h4>
      <ul style="list-style-type: none; padding-left: 0;" class="ff">
        <li style="color: #ccccccce;"><a class="hh" href="tel:+212570180988" style="color: #ccccccce; text-decoration: none;">Téléphone: <span style="color: #fff;">+212 570 180 988</span></a></li>
        <li style="color: #ccccccce;"><a href="mailto:servicepieceauto@gmail.com" style="color: #ccccccce; text-decoration: none;">Email: <span style="color: #fff;">pieceauto@gmail.com</span></a></li>
        <li style="color: #ccccccce;"><a href="https://www.google.com/maps/search/?api=1&query=NTIC2+SM,+Casablanca,+Maroc" style="color: #ccccccce; text-decoration: none;">Adresse: <span style="color: #fff;">NTIC2 SM, Casablanca, Maroc</span></a></li>
      </ul>
    </div>
  </div>
  <hr style="background-color: #53525256">
  <p class="text-center" style="color: #ccc;">© 2024 Notre Site de Pièces Automobiles. Tous droits réservés.</p>
</footer>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $(".faq-question").click(function(){
      $(this).next(".faq-answer").slideToggle();
    });
    $("#aide-contact").click(function(){
      $("#message-box").slideToggle();
    });
  });
</script>

</body>
</html>
