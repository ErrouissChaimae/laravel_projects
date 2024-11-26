<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pièces Auto - E-commerce</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
      background-color: #7a78781f;
    }

    header {
      background-color: #000000;
      color: #fff;
      padding: 20px 0;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    nav ul li {
      margin-right: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s;
    }

    nav ul li a:hover {
      color: #ff2407;
    }

    .logo {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .search-bar {
      max-width: 400px;
      width: 100%;
    }

    .search-bar input[type="text"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .search-bar button {
      background-color: #e90707;
      color: #fff;
      border: none;
      border-radius: 20px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-bar button:hover {
      background-color: #928c78;
    }

    .card {
      box-shadow:1px 1px 2px #c70b0b;
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.3s;
      height: 100%;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card img {
      max-width: 100%;
      height: 200px; 
      object-fit: cover; 
    }

    .card-title {
      font-weight: bold;
      margin-top: 10px;
    }

    .card-subtitle {
      color: #6c757d;
    }

    .btn-buy {
  background-color: #ed2315;
  color: #fff;
  border: 2px solid #ed2315;
  border-radius: 20px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.btn-buy:hover {
  background-color: transparent;
  color: #ff1100;
    border: 2px solid #ed2315;

}

    footer {
      background-color: #000;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    footer ul {
      list-style: none;
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }

    footer ul li {
      margin-right: 20px;
    }

    footer ul li a {
      color: #fff;
      text-decoration: none;
    }

    footer ul li:last-child {
      margin-right: 0;
    }

    footer ul li a:hover {
      color: #ff0f07;
    }
    .fa-star {
      color: rgb(236, 236, 56);
    }
    .m:hover{
background-color: #ff0f07;
    }
    
header {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000; 
}

.btn-outline-light:hover i {
  color: #fff; /* Couleur blanche */
}

main {
  padding-top: 100px; 
  padding-bottom: 100px;
}

    </style>
</head>
<body>
  <header>
    <nav class="container">
      <img src="images/logo4.jpg" alt=""  width="100">
      <div class="search-form">
        <form id="filterForm" action="{{ route('articlesliste.index') }}" method="GET" class="d-flex">
          @csrf
          <input type="text" id="keyword" name="keyword" class="form-control me-2" placeholder="Rechercher une pièce" value="{{ $keyword ?? '' }}">
          <button type="submit" class="btn btn-outline-light m"><i class="fas fa-search"></i></button>
        </form>
      </div>
      <ul>
        <li><a href="{{ route('accueil') }}">Accueil</a></li>
        <li><a href="#listing_microdata">Avis Client</a></li>
        <li><a href="{{ route('client.commandes') }}"><i class="fas fa-shopping-cart"></i></a></li>
        <li><a href="{{ route('client.profile') }}"><i class="fas fa-user"></i></a></li>
      </ul>
    </nav>
  </header>

  <main class="container my-4">
    <div class="row">
      <h2 class="text-center">Top 3 articles</h2>
<div class="col-12 mb-3 text-center">
  <div class="row align-items-center justify-content-center g-3">
    <div class="col-4 text-end" style="width: 20%;"> 
      @foreach ($topArticles->skip(1)->take(1) as $article)
      <div class="card text-center">
        <img src="{{ asset('images/' . $article->photo) }}" class="card-img-top" alt="Article Image">
        <div class="card-body">
          <h5 class="card-title">{{ $article->libele }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Prix: {{ $article->prix }}</h6>
          <div class="buy-container">
            <button class="btn btn-buy" data-article-id="{{ $article->id_article }}" >Acheter</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-4 text-center" style="width: 20%;min-height:380px;"> 
      @foreach ($topArticles->take(1) as $article)
      <div class="card " >
        <img src="{{ asset('images/' . $article->photo) }}" class="card-img-top" alt="Article Image">
        <div class="card-body">
          <h5 class="card-title">{{ $article->libele }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Prix: {{ $article->prix }}</h6>
          <div class="buy-container">
            <button class="btn btn-buy" data-article-id="{{ $article->id_article }}" >Acheter</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-4 text-center" style="width: 20%;"> 
      @foreach ($topArticles->skip(2)->take(1) as $article)
      <div class="card " >
        <img src="{{ asset('images/' . $article->photo) }}" class="card-img-top" alt="Article Image">
        <div class="card-body">
          <h5 class="card-title">{{ $article->libele }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Prix: {{ $article->prix }}</h6>
          <div class="buy-container">
            <button class="btn btn-buy" data-article-id="{{ $article->id_article }}" >Acheter</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<hr>

<h2 class="text-center" style="color: #000">listes articles</h2>
@foreach ($articles as $article)
      <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="card" >
          <img src="{{ asset('images/' . $article->photo) }}" class="card-img-top" alt="Article Image">
          <div class="card-body">
            <h5 class="card-title">{{ $article->libele }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Prix: {{ $article->prix }}</h6>
            <div class="buy-container">
              <button class="btn btn-buy" data-article-id="{{ $article->id_article }}" >Acheter</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </main>
  <div class="listing_microdata " id="listing_microdata">
    <div class="car_tires_review_block">
        <div class="title_t text-center"> <h3>Pneus sur le boutique pieces Auto: Critiques et expériences</h3></div>
        <br>
        <div class="revs">
                                <div class="item">
                    <div class="name_r">D. A.</div>
                    <ul>
                        <li><i class="fas fa-star"></i></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></li>
                                                </ul>
                    <span>2024-01-27</span>
                    <p>Excellente tenue de route, silencieux je recommande.Montés sur Opel Combo 1.5 130CV de 2021.</p>
                </div>
                                    <div class="item">
                    <div class="name_r">I. K.</div>
                    <ul>
                      <li><i class="fas fa-star" "></i></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></li>
                      <span>2024-01-25</span>
                    <p>Ya un rond point près de chez moi je prend obligatoirement en aller et retour j'ai toujours glisser et taper contre la bordure même avec la troisième depuis que j'ai ces 2 pneu sur l'essieu traction avant je glisse pas! accroche a la route et sur la national sur la neigé il a jamais glisser conduite confortable!</p>
                </div>
                                    <div class="item">
                    <div class="name_r">G. A.</div>
                    <ul>
                      <li><i class="fas fa-star "></i></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></li>
                    </ul>
                    <span>2023-12-21</span>
                    <p>Tenue de cap irréprochable, aussi bien sur neige que sur sec ou sous la pluie....Montés depuis 3 ans à l'arrière sur une Clio4, semblent inusables !!!</p>
                </div>
                                    <div class="item">
                    <div class="name_r">C. E.</div>
                    <ul>
                      <li><i class="fas fa-star"></i></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></li>
                    </ul>
                    <span>2023-11-27</span>
                    <p>bon pneu  en conduite rapideparfait compte tenu du prix voir la longévité</p>
                </div>
                            </div>
                            <br><br><br>
    </div>
</div>
<style>
  .listing_microdata {
  display: flex;
  flex-direction: column;
}

.car_tires_review_block {
  width: 100%;
}

.revs {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto; 
  gap: 20px; 
}

.item {
  flex: 0 0 auto; 
  width: 300px; 
  border: 1px solid #ccc; 
  padding: 20px; 
}

.name_r {
  font-weight: bold;
}

.item ul {
  list-style: none;
  padding: 0;
}

.item span {
  display: block;
  margin-bottom: 10px;
  font-style: italic;
}

</style>
<script>
  var avisClients = [
    { nom: "chaimae", commentaire: "Service excellent ! Je recommande vivement." },
    { nom: "ghizlane", commentaire: "Livraison rapide et produits de qualité." },
  ];
  
  function afficherAvisClients() {
    var avisContainer = document.getElementById('avis-clients');
    avisContainer.innerHTML = ''; 
  
    avisClients.forEach(function(avis) {
      var avisHTML = '<div class="avis">';
      avisHTML += '<h4>' + avis.nom + '</h4>';
      avisHTML += '<p>' + avis.commentaire + '</p>';
      avisHTML += '</div>';
  
      avisContainer.innerHTML += avisHTML;
    });
  }
  
  afficherAvisClients();
  </script>  
<style>.panel {
  margin-top: 20px;
  border-radius: 5px;
  border: 1px solid #ddd;
}

.panel-heading {
  background-color: #f5f5f5;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.panel-title {
  margin-top: 0;
  margin-bottom: 0;
}

.panel-body {
  padding: 20px;
}

.avis {
  margin-bottom: 20px;
  border-bottom: 1px solid #ddd;
}

.avis:last-child {
  border-bottom: none;
}
</style>
  <footer>
    <p>Pièces Auto - E-commerce &copy; 2024</p>
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Boutique</a></li>
      <li><a href="#">A propos</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
 document.addEventListener('DOMContentLoaded', function () {
      const buyButtons = document.querySelectorAll('.btn-buy');
      buyButtons.forEach(button => {
        button.addEventListener('click', function () {
          const articleId = this.dataset.articleId;
          const form = document.createElement('form');
          form.classList.add('buy-form');
          form.innerHTML = `
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantité:</label>
              <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
            </div>
            <input type="hidden" name="article_id" value="${articleId}">
            <button type="submit" class="btn btn-danger">Ajouter la commande</button>
          `;
          const cardBody = this.closest('.card-body');
          const buyContainer = cardBody.querySelector('.buy-container');
          buyContainer.appendChild(form);
          this.style.display = 'none';
  
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            formData.append('quantite', this.querySelector('#quantity').value);
  
            fetch('{{ route("storecommande") }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Afficher un message de confirmation
                alert(data.message);
                // Recharger la page
                location.reload();
              } else {
                alert('Une erreur est survenue : ' + data.message);
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('Une erreur est survenue lors de l\'ajout de la commande.');
            });
          });
        });
      });
    });  </script>
</body>
</html>
