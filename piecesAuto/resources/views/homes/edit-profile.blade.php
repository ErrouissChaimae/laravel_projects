<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modifier Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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
        max-width: 700px;
        margin: auto;
        background-color: rgba(2, 2, 2, 0.76);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(255, 7, 7, 0.3);
        margin-top: 3%;
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #c40d0d;
    }
    form {
        max-width: 500px;
        margin: auto;
    }
    label {
        color: #fff;
    }
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        outline: none;
    }
    button[type="submit"] {
        width: 50%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #c40d0d;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    button[type="submit"]:hover {
        background-color: #ff6b6b;
    }
</style>
<body>
    <div class="container">
        <h1>Modifier Profil</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('client.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $client->nom) }}">
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $client->prenom) }}">
            </div>
            <div>
                <label for="telephone">Téléphone:</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $client->telephone) }}">
            </div>
            <div>
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $client->adresse) }}">
            </div>
            <center><button type="submit">Mettre à jour</button></center>
        </form>
    </div>

    <!-- Mettez ici vos scripts JavaScript si nécessaire -->
</body>
</html>
