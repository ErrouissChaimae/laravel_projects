<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            padding-top: 20px;
            background-image: url('https://images.hdqwalls.com/download/porsche-rwb-911-4k-n5-1400x900.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: rgba(2, 2, 2, 0.459);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(255, 7, 7, 0.3);
            margin-top: 7%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .profile-info {
            margin-bottom: 30px;
        }

        .profile-info p {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .edit-link {
            display: inline-block;
            padding: 12px 25px;
            background-color: #c40d0d;
            color: #ffffff;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .edit-link:hover {
            background-color: #ff6b6b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Votre profil</h1>

        <div class="profile-info">
            <p><strong>Nom:</strong> {{ $client->nom }}</p>
            <p><strong>Prénom:</strong> {{ $client->prenom }}</p>
            <p><strong>Email:</strong> {{ $client->email }}</p>
            <p><strong>Téléphone:</strong> {{ $client->telephone }}</p>
            <p><strong>Adresse:</strong> {{ $client->adresse }}</p>
            <!-- Vous pouvez afficher d'autres informations ici selon les besoins -->
        </div>

        <!-- Lien ou bouton pour permettre à l'utilisateur de modifier ses données -->
        <center><a href="{{ route('client.editProfile') }}" class="edit-link">Modifier les informations</a></center>
    </div>

    <!-- Mettez ici vos scripts JavaScript si nécessaire -->
</body>
</html>
