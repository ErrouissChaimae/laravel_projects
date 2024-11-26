<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #7a78781f;
            background-repeat: no-repeat;
            background-size: cover;
        }

      
    
        .h1a {
            display: flex;
            background-color: #000000;
            justify-content: space-between;
            padding: 10px;
            position: fixed;
            width: 100%;
        }

        .bt {
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .bt:hover {
            color: #ef1313;
        }

        .command-container {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 8px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            box-shadow: 5px 5px 8px rgba(255, 0, 0, 0.908); /* Rouge avec une opacité de 0.5 */
        }

        .article-img {
            max-width: 100px; /* Ajustez la taille de l'image selon vos besoins */
            height: auto;
            border-radius: 8px;
            margin-right: 10px;
        }

        .command-details {
            flex-grow: 1;
        }
    </style>
</head>
<body> <div class="h1a">
            <h1 style="color: #ffffff" >Mes Commandes</h1>
            <a href="{{ route('articlesliste.index') }}" class="bt">Articles</a>
        </div>
        <br>        <br>
        <br>
        <br>

    <div class="container">
       
        
        @if ($commandes->isEmpty())
            <p>Vous n'avez aucune commande pour le moment.</p>
        @else
            @foreach ($commandes as $commande)
                <div class="command-container">
                    <img src="{{ asset('images/' . $commande->article->photo) }}" alt="Photo de l'article" class="article-img">
                    <table class="command-details">
                        <tr class="table-header">
                            <th colspan="2">Commande {{ $commande->id }}</th>
                        </tr>
                        <tr>
                            <th>Date de commande:</th>
                            <td>{{ $commande->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Article:</th>
                            <td>{{ $commande->article->libele }}</td>
                        </tr>
                        <tr>
                            <th>Quantité:</th>
                            <td>{{ $commande->quantite }}</td>
                        </tr>
                        <tr>
                            <th>Prix unitaire:</th>
                            <td>{{ $commande->prix_unitaire }}</td>
                        </tr>
                        <tr>
                            <th>Prix total:</th>
                            <td>{{ $commande->prix_total }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
