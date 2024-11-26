@extends('layouts.app2')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
        <div class="col-sm-4">
            <h1>Gestion des Commandes:</h1>
          </div>
          <div class="col-sm-4">
            <form action="{{ route('all.search') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search by Client or ticket" required style="border-radius: 20px">
                    <button type="submit" class="btn btn-warning" style="background-color:#ffab2e;border-radius: 100px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"color="white" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg></button>
                </div>
            </form>
          </div>

        <div class="col-sm-4">
            <h3 data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="float: right"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
              </svg>
            </h3>
    
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="background-color: rgb(255, 255, 255)">
                <div class="offcanvas-header">
                  <h2 class="offcanvas-title" id="offcanvasScrollingLabel">  
                      <img src="/images/2.png" width="100px">Dashboard menu</h2>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="background-color: rgb(255, 255, 255); color:antiquewhite;"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="grid">
    
                        <li>
                            <p><a href="{{ url('/dashboard') }}"  class="style-2" class="icon-link icon-link-hover"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                              </svg> Client</a></p>		
                        </li>
                            <li>
                            <p><a href="{{ route('autocars.index') }}" class="style-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bus-front-fill" viewBox="0 0 16 16">
                                <path d="M16 7a1 1 0 0 1-1 1v3.5c0 .818-.393 1.544-1 2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V14H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2a2.5 2.5 0 0 1-1-2V8a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1V2.64C1 1.452 1.845.408 3.064.268A44 44 0 0 1 8 0c2.1 0 3.792.136 4.936.268C14.155.408 15 1.452 15 2.64V4a1 1 0 0 1 1 1zM3.552 3.22A43 43 0 0 1 8 3c1.837 0 3.353.107 4.448.22a.5.5 0 0 0 .104-.994A44 44 0 0 0 8 2c-1.876 0-3.426.109-4.552.226a.5.5 0 1 0 .104.994M8 4c-1.876 0-3.426.109-4.552.226A.5.5 0 0 0 3 4.723v3.554a.5.5 0 0 0 .448.497C4.574 8.891 6.124 9 8 9s3.426-.109 4.552-.226A.5.5 0 0 0 13 8.277V4.723a.5.5 0 0 0-.448-.497A44 44 0 0 0 8 4m-3 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0m8 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m-7 0a1 1 0 0 0 1 1h2a1 1 0 1 0 0-2H7a1 1 0 0 0-1 1"/>
                              </svg> Autocars </a></p>		
                        </li>
                            <li>
                            <p><a href="{{ route('tickets.index') }}" class="style-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-perforated" viewBox="0 0 16 16">
                                <path d="M4 4.85v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9z"/>
                                <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3zM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9z"/>
                              </svg>  Tickets</a></p>		
                        </li>
                        <li>
                            <p><a href="{{ route('commandes.all') }}" class="style-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                              </svg>Commandes</a></p>		
                        </li>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
            </div>
        </div>
        @if($commandes->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Ticket</th>
                        <th>Quantité</th>
                        <th>Prix Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        @php
                            $isPast = $commande->ticket->date < now();
                        @endphp
                        <tr class="{{ $isPast ? 'table-danger' : '' }}">
                            <td>{{ $commande->client->name }}</td>
                            <td>{{ $commande->ticket->id_ticket }}</td>
                            <td>{{ $commande->quantite }}</td>
                            <td>{{ $commande->prix_total }} Dhs</td>
                            <td>{{ $commande->ticket->date->format('d/m/Y') }}</td>
                            <td>
                                @if($isPast)
                                <form action="{{ route('commandes.deletePast', $commande->id_commande) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this past order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                        </svg>
                                    </button>
                                </form>
                                
                                
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

           <center> <div class="pagination-links">
            {{ $commandes->links('pagination::bootstrap-4') }}
        </div></center>
        @else
            <p>Aucune commande trouvée.</p>
        @endif
    </div>

    @include('layouts.footer')
<style> 
 .icon-button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }
    .icon-button svg {
        vertical-align: middle;
    }

     /* Variables */
     :root {
            --link-1: #ffab2e;
            --text: #000000;
        }
        
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        a {
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            font-size: 21px;
            line-height: 1.5;
        }
        
        .grid {
            list-style: none;
            padding-left: 0;
        }
        
        .grid li {
            position: relative;
            padding-left: 20px; /* Adjust this for line spacing */
            margin-bottom: 1rem; /* Adjust the spacing between list items */
        }
        
        .grid li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px; /* Line width */
            background-color: var(--link-1);
        }
        
        .style-2 {
            position: relative;
            transition: color 0.3s ease-in-out;
            display: flex;
            align-items: center; /* Ensure vertical alignment with icons */
        }
        
        .style-2::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--link-1);
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }
        
        .style-2:hover {
            color: var(--link-1);
        }
        
        .style-2:hover::after {
            transform: scaleX(1);
        }
        
        .style-2 svg {
            transition: transform 0.3s ease-in-out;
           margin-right: 5px;
        }
        
        .style-2:hover svg {
            transform: translateY(-6px);
            width: 65px;
            height: 25px; 
        }
        .icon-link-hover {
            margin-left: 10px; 
        }
</style>
@endsection
