@extends('layouts.appc')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.0/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
     
        .error-message {
            color: red;
        }
    
     
     .mini-hr {
            border: none; 
            height: 2px;
            background-color: #ff851b; 
            width: 150px;
            margin: 0; 
            margin-top: 5px; 
        }
    </style>
</head>
<body style="background-color:#fffcfc;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: rgb(255, 255, 255); box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
        <img src="/images/1.png" width="150px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="#con">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">FAQ</a>
                </li>
                <li class="nav-item">
                   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal" style="border-radius: 50px;background-color:green;border-raduis:5px;">
                        <i class="bi bi-person-circle" ></i> Se connecter
                    </button>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#con">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('commandes.index') }}">Mes Commandes</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="border:none;">
                        <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right" ></i> {{ __('Exit') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <br>

    <div id="main-content">
        <main>
            <section class="banner">
                <div class="banner-content">
                    <h1>TROUVEZ <br> ET RÉSERVEZ <br> EN MOINS DE 2 MINUTES</h1>
                    <button style="box-shadow: 1px 1px 1px 1px rgb(67, 64, 59);"><strong>Trouver votre ticket</strong></button>
                    <br><br>
                </div>
                <div class="hero-image">
                    <img src="/images/x.png" alt="YallaRkab">
                </div>
            </section>

            <section class="search-section" style="position: relative;">
                <form class="search-form" action="{{ route('search1') }}" method="GET">
                    <div style="position: relative;">
                        <input type="text" name="ville_depart" id="ville_depart" class="form-control" placeholder="Ville de départ" autocomplete="off" style="position:inherit; width:100%">
                        <div id="ville_depart_suggestions" class="suggestions"></div>
                    </div>
                    <br>
                    <div style="position: relative;">
                        <input type="text" name="ville_arrivee" id="ville_arrivee" class="form-control" autocomplete="off" placeholder="Ville d'arrivée" style="position:inherit; width:100%">
                        <div id="ville_arrivee_suggestions" class="suggestions"></div>
                    </div>
                    <input type="date" name="date" class="form-control">
                  
                    <button id="submitForm" class="btn btn-warning" style="color: rgb(255, 255, 255); background-color: orange; border-radius: 100px; padding:10px;" type="submit">Recherche <i class="bi bi-search" style="width: 5px; height:5px;"></i></button>
                </form>
            </section>
    <div class="container">    
            <div class="row">
                @if($tickets->isNotEmpty())
                <br>
                <div class="col-sm-4" >
                    <h2>Réinitialiser les filtres</h2>
                <hr class="mini-hr">
                <br>
                    <form id="filterForm" action="{{ route('filterTickets') }}" method="GET" style="background-color: none; border-radius: 10px;  box-shadow: -2px -2px 6px rgba(255, 102, 0, 0.3);height:300px;">
                        <h5 style="margin-left:8px;">Société</h4>
                        @foreach($autocars as $id => $nom)
                            <label for="autocar_{{ $id }}" style="display: block; padding: 5px; margin-bottom: 5px; margin-left:10px;">
                                <input type="checkbox" name="autocar[]" id="autocar_{{ $id }}" value="{{ $id }}" {{ in_array($id, (array)request('autocar', [])) ? 'checked' : '' }}>
                                {{ $nom }}
                            </label>
                        @endforeach
                    </form>
                </div>
                
                

            
                <div class="col-sm-8">
                 
                    @foreach ($tickets as $ticket)
                        <div class="ticket3 {{ $ticket->quantite_tickets == 0 ? 'ticket-disabled' : '' }}">
                            <div class="ticket3__details">
                                <h3 class="ticket3__title">{{ $ticket->autocar->nom }}</h3>
                                <ul>
                                    <li>
                                        <img src="{{ asset('images/' . $ticket->autocar->photo) }}" alt="{{ $ticket->autocar->nom }}" width="150">
                                    </li>
                                    <li class="centered-content">
                                        <div>
                                           <center> <p style="font-size: 20px;margin-left: 50px; ">{{ $ticket->heure_depart }} --> {{ $ticket->heure_arrivee }}</p>
                                           </center></div>
                                    </li>
                                    <li class="centered-content">
                                        <div>
                                            <span style="font-size: 20px;margin-left: 190px;">
                                                <a class="bi bi-geo-alt-fill" style="color: #ff6105"></a>
                                                {{ $ticket->ville_depart }} <i class="bi bi-arrow-right" style="color: #ff6105"></i>
            
                                                {{ $ticket->ville_arrivee }}
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="ticket3__rip"></div>
                            <div class="ticket3__price">
                                <span class="heading">Prix</span>
                                <center>
                                    <span class="price">{{ $ticket->prix }} Dhs <br>
                                        @if($ticket->quantite_tickets > 0)
                                        <a href="javascript:void(0);" class="fd order-btn" data-ticket='@json($ticket)'>Acheter 
                                            <i class="bi bi-arrow-right"></i></a>                                        @else
                                            <center><a href="#" disabled style="color: #d8d7d7;font-size:20px">Ticket terminé !</a></center>
                                        @endif
                                    </span>
                                </center>
                            </div>
                        </div>
                    @endforeach
            
                    <div class="pagination-links" style="margin-left: 100px;">
                        {{ $tickets->links('pagination::bootstrap-4') }}
                    </div>
                    @else
                    <div class="col-sm-12">
                        @if(request()->has('ville_depart') || request()->has('ville_arrivee') || request()->has('date'))
                            <center><p style="color: rgb(153, 152, 152)">Aucun ticket ne correspond à vos critères de recherche!</p></center>
                        @endif
                
                    </div>
                @endif
                </div>
            
            
      </div>
    </div>
    
            
            

            <div style="margin: 30px">

            <div  id="faq">
                <br>
                
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Nos partenaires
                        </h3>
                        <hr class="mini-hr">

                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Slide 1 -->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/globus.jpg" class="img-responsive hidden-xs" style=" width:150px"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" style="margin-bottom: 13px">
                                            <div class="thumbnail">
                                                <a href="#"><img class="img-responsive hidden-xs" src="/images/ctm.jpg" alt="" style="width: 150px; "></a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-6">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/ghazala.jpg" class="img-responsive hidden-xs" src="/" alt="" style=" width:150px"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/bolman.jpg" class="img-responsive hidden-xs" src="/" alt="" style=" width:150px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Slide 2 -->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/sotram.jpg" class="img-responsive hidden-xs" src="/" alt="" style=" width:150px"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" style="margin-bottom: 13px">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/jana.jpg" class="img-responsive hidden-xs" src="/" alt=""style=" width:150px"></a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-6">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/salama.jpg" class="img-responsive hidden-xs" src="/" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="thumbnail">
                                                <a href="#"><img src="/images/super.jpg" class="img-responsive hidden-xs" src="/" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more slides as needed -->
                            </div>
                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    
                <div class="col-sm-6">
                <h2>Foire aux questions (FAQ)</h2>
                <hr class="mini-hr">

                <div class="accordion" >
                    <div class="accordion-item">
                        <button id="accordion-button-4" aria-expanded="false">
                            <span class="accordion-title">Q1 : Qui sommes-nous ?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>Nous sommes YallahRkab.ma, une plateforme dédiée à la réservation de billets d’autocar. Notre mission est de faciliter vos déplacements en vous offrant un service de réservation en ligne rapide et fiable. Nous travaillons en partenariat avec diverses sociétés de transport pour garantir votre place et votre confort lors de vos voyages.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false">
                            <span class="accordion-title">Q2 :Comment être sûr d'avoir sa place réservée dans l'autocar?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>YallahRkab.ma est un site marchand de billets d’autocars, partenaire de toutes les sociétés de transports visibles sur la plateforme www.YallahRkab.ma. Dès lors que vous confirmez votre réservation, les données sont transmises immédiatement à la société de transport concernée. Cela permet de garantir la réservation de votre place auprès de l’opérateur partenaire.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-2" aria-expanded="false">
                            <span class="accordion-title">Q3 : YallahRkab.ma prélève-t-il des frais de réservation ?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>Oui, des frais de réservation de 5 dh par ticket peuvent être applicables sur certains trajets.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button id="accordion-button-3" aria-expanded="false">
                            <span class="accordion-title">Q4 : Comment puis-je payer pour mon billet ?</span>
                            <span class="icon" aria-hidden="true"></span>
                        </button>
                        <div class="accordion-content">
                            <p>Après la réservation, il vous sera demandé de payer votre billet. Vous pourrez choisir entre un paiement en ligne par carte bancaire ou PayPal, ou un paiement en espèces auprès des agences de cash (CashPlus, Wafacash, Fawatir, DAMANE Cash, Lana Cash). Vous pouvez également utiliser le paiement mobile via MT Cash ou votre application bancaire (CIH, BMCE, Crédit agricole, Société Générale). Notre plateforme accepte tous types de cartes bancaires (Visa, Electron, CMI, Mastercard, JCB).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
             <br>
        </main>
    </div>
</div>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5  class="modal-title" id="loginModalLabel"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16" style="color: rgb(255, 126, 27)">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                      </svg> Authentification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('includes.login-client')
                </div>
            </div>
        </div>
    </div>
    @include('includes.modal')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
//filter2

    document.querySelectorAll('input[name="autocar[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });


 //faq
 const items = document.querySelectorAll('.accordion button');

 function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');

  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }

  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
 }

 items.forEach((item) => item.addEventListener('click', toggleAccordion));





        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: '{{ route("login.client") }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            $('#loginError').text(response.message).removeClass('d-none');
                        }
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;

                        $('#email').val('');
                        $('#password').val('');
                        $('#emailError').text(errors.email ? errors.email[0] : '').toggleClass('d-none', !errors.email);
                        $('#passwordError').text(errors.password ? errors.password[0] : '').toggleClass('d-none', !errors.password);
                        $('#loginError').text('Les informations d\'identification sont incorrectes.').removeClass('d-none');
                    }
                });
            });
        });
    </script>
    <script>




        document.addEventListener('DOMContentLoaded', function () {
          const villesUrl = "{{ asset('moroccan_cities.json') }}";
      
          function fetchCities(inputElement, suggestionsElementId) {
              inputElement.addEventListener('input', function () {
                  const query = inputElement.value.toLowerCase();
                  const suggestionsElement = document.getElementById(suggestionsElementId);
      
                  fetch(villesUrl)
                      .then(response => response.json())
                      .then(cities => {
                          suggestionsElement.innerHTML = '';
                          const filteredCities = cities.filter(city => city.name.toLowerCase().startsWith(query));
                          filteredCities.forEach(city => {
                              const suggestion = document.createElement('div');
                              suggestion.classList.add('suggestion');
                              suggestion.textContent = city.name;
                              suggestion.addEventListener('click', () => {
                                  inputElement.value = city.name;
                                  suggestionsElement.innerHTML = '';
                              });
                              suggestionsElement.appendChild(suggestion);
                          });
                      });
              });
          }
      
          fetchCities(document.getElementById('ville_depart'), 'ville_depart_suggestions');
          fetchCities(document.getElementById('ville_arrivee'), 'ville_arrivee_suggestions');
      
          // Submission of the form
          document.getElementById('submitForm').addEventListener('click', function () {
              document.querySelector('.search-form').submit();
          });

          $('.order-btn').on('click', function() {
        var ticket = $(this).data('ticket');
        $('#modalAutocarName').text(ticket.autocar.nom);
        $('#modalAutocarPhoto').attr('src', '/images/' + ticket.autocar.photo);
        $('#modalHeure').text(ticket.heure_depart + ' --> ' + ticket.heure_arrivee);
        $('#modalVilleDepart').text(ticket.ville_depart);
        $('#modalVilleArrivee').text(ticket.ville_arrivee);
        $('#modalPrix').text(ticket.prix + ' Dhs');
        $('#modalIdTicket').val(ticket.id_ticket);
        $('#orderModal').modal('show');
    });
      });
      </script>
</body>
<style>
    .thumbnail {
        padding: 0;
        border: none;
    }
    .carousel-item .row {
        display: flex;
        justify-content: center;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5); /* Adjust color as needed */
    }
 
</style>

<style>

 img { max-width:100%; }

 .carousel-control{
       color: #000 !important;
       border: 0px;
       border-radius: 0px;
       display: inline-block;
       font-size: 16px;
       font-weight: 200;
       line-height: 18px;
       opacity: 0.5;
       padding: 4px 0px 0px;
       position: absolute;
       height: 30px;
       width: 15px;
       top: 0;
    background: none !important;
       }




 .accordion .accordion-item {
 border-bottom: 1px solid #e5e5e5;
 }

.accordion .accordion-item button[aria-expanded='true'] {
 border-bottom: 1px solid #ff8000;
}

.accordion button {
 position: relative;
 display: block;
 text-align: left;
 width: 100%;
 padding: 1em 0;
 color: #000000;
 font-size: 1.15rem;
 font-weight: 400;
 border: none;
 background: none;
 outline: none;
}

.accordion button:hover,
.accordion button:focus {
 cursor: pointer;
  color: #ff8000;
}

.accordion button:hover::after,
.accordion button:focus::after {
 cursor: pointer;
 color: #ff8000;
 border: 1px solid #ff8000;
}

.accordion button .accordion-title {
 padding: 1em 1.5em 1em 0;
}

.accordion button .icon {
 display: inline-block;
 position: absolute;
 top: 18px;
 right: 0;
 width: 22px;
 height: 22px;
 border: 1px solid;
 border-radius: 22px;
} 

.accordion button .icon::before {
 display: block;
 position: absolute;
 content: '';
 top: 9px;
 left: 5px;
 width: 10px;
 height: 2px;
  background: currentColor;
}
.accordion button .icon::after {
 display: block;
 position: absolute;
 content: '';
 top: 5px;
 left: 9px;
 width: 2px;
 height: 10px;
 background: currentColor;
}

.accordion button[aria-expanded='true'] {
 color: #ff8000;
}
.accordion button[aria-expanded='true'] .icon::after {
  width: 0;
}
.accordion button[aria-expanded='true'] + .accordion-content {
 opacity: 1;
 max-height: 9em;
 transition: all 200ms linear;
 will-change: opacity, max-height;
}
.accordion .accordion-content {
 opacity: 0;
 max-height: 0;
 overflow: hidden;
 transition: opacity 200ms linear, max-height 200ms linear;
 will-change: opacity, max-height;
}
.accordion .accordion-content p {
 font-size: 1rem;
 font-weight: 300;
  margin: 2em 0; 
 }

         .fd {
            fill:#ffffff; 
            transition: fill 0.3s, color 0.3s, height 0.3s;
            color:#ffffff;
            text-decoration: none;
            font-size: 20px;
        }
        .fd:hover {
            height: 25px;
            color: #ff8000;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 15px;

        } 
        .fd:hover i{
            padding-left: 5px; /* Adjust this for line spacing */
            fill: #ffffff;
            color: #ff8000;

        } 
    .ticket-disabled {
    opacity: 0.5;
    pointer-events: none; 
   }

    .suggestions {
    border: 1px solid #f5f5f5;
    max-height: 100px; 
    width: 130px; /* Fixed width for the suggestions */
    overflow-y: auto; /* Scrollbar if necessary */
    background-color: #f4f3f3;
    z-index: 1000;
    position: absolute; /* Ensure the suggestions are positioned absolutely */
    top: 100%; /* Position the suggestions right below the input */
    left: 0;
    }

  .suggestion {
    padding: 10px;
    cursor: pointer;
  }

  .suggestion:hover {
    background-color: orange;
    color: #ffffff;
  }

  .search-section {
    position: relative; /* Ensure the search-section is the reference point for absolute positioning */
  }


    .centered-content {
        text-align: center;
        margin-left: 100px;
        top: -50px;
    position: relative;
    }

    .centered-content div {
        display: inline-block;
    }

    .ticket3 {
        position: relative;
        display: flex;
        flex-direction: row;
        width: 700px;
        height: 200px;
        margin: 100px;
    }

    .ticket3__details {
        flex: 3;
        background-color: #f7f7f7;
        min-height: 150px;
        padding: 1rem;
        border-radius: 5px 0 0 5px;
    }

    .ticket3__details .ticket3__title {
        margin-top: 0;
    }

    .ticket3__details ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .ticket3__details ul li {
        margin: .7rem 0;
    }

    .ticket3__rip {
        position: relative;
        background-color: #f6f6f6;
        background-image: linear-gradient(90deg, #f7f7f7 49%, #ff9900 50%);
        width: 30px;
    }

    .ticket3__rip::before,
    .ticket3__rip::after {
        position: absolute;
        content: "";
        width: 20px;
        height: 20px;
        border: 20px solid transparent;
        border-top-color: #fff;
        left: 50%;
        transform: translateX(-50%) rotate(135deg);
        border-radius: 50%;

    }

    .ticket3__rip::before {
        top: -20px;

          border-top-color: #ffffff;
        border-right-color: #ffffff;
    }

    .ticket3__rip::after {
        bottom: -20px;
        border-right-color: #ffffff;
        border-top-color: #ffffff;
        transform: translateX(-50%) rotate(-45deg);
    }

    .ticket3__price {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1;
        background-color: #ff9d00;
        min-height: 150px;
        padding: 1rem;
        border-radius: 0 5px 5px 0;
        color: #fff;
    }

    .ticket3__price .heading {
        font-size: 2rem;
        margin-bottom: .2rem;
        color: #ffffff;
    }

    .ticket3__price .price {
        font-size: 25px;
        font-weight: bold;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        padding: 10px 20px;
    }

    header .logo {
        color: #fff;
        font-size: 24px;
        font-weight: bold;
    }

    header nav ul {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    header nav ul li {
        margin-left: 20px;
    }

    header nav ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }

    .banner {
        display: flex;
        height: 300px;
        width: 100%;
    }

    .banner-content {
        background-color: rgb(255, 166, 0);
        color: white;
        flex-grow: 1;
        padding: 20px;
        box-sizing: border-box;
    }

    .banner-content h1 {
        margin: 0 0 20px;
        margin-left: 70px;
        font-size: 34px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .banner-content button {
        background-color: white;
        color: #FF8E26;
        border: none;
        padding: 10px 20px;
        margin-left: 70px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .hero-image {
        width: 20%;
        background-color: rgb(255, 255, 255);
        display: flex;
        position: relative;
        right: 3%;
    }

    .hero-image img {
        width: 300px;
        display: flex;
        position: relative;
        right: 70%;
    }

    .search-section {
        background-color: white;
        padding: 20px;
        position: fixed;
    }

    .search-section {
        background-color: white;
        padding: 20px;
        position: fixed;
        border-radius: 100px;
        box-shadow: 1px 1px 1px 3px #ff6105;
        text-align: center;
        margin: -30px 20px 20px;
        position: relative;
        z-index: 1;
    }

    .search-form {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .search-form input,
    .search-form button {
        padding: 10px;
        margin: 5px;
        font-size: 16px;
    }

    .search-form input {
        width: 20%;
        border: none;
    }

    .results {
        display: flex;
        justify-content: space-around;
        padding: 20px;
    }

    .result-box {
        width: 23%;
        height: 150px;
        background-color: #f0f0f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .inputs {

    }
</style>
</html>
<div id="con">
    @include('layouts.footer1')
  </div>

@endsection
