<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Personne</title>
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

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding-top: 50px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px #e2c6a2;
            border-radius: 10px;
            overflow: hidden;
            animation: fadeInUp 0.5s ease forwards;
            margin-top: 3%;

        }

        .card-header {
            background-color: #FDEBD7;
            color: #ddb785;
            font-weight: bold;
            text-align: center;
            padding: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #D2B48C;
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border-color: #D2B48C;
        }

        .btn-register {
            background-color: #af670ac5;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #c49a58;
        }

        .text-danger {
            color: #ff0000;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="width: 80%">   
        <div class="row">
            <div class="col-md-6">
             
                <img src="/images/bg.png" style="width: 95%;margin-top:5%">

            </div>
            <div class="col-md-6">
               
        <div class="card">
            
            <div class="card-body">
                <form action="{{ route('personne.register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cin">CIN:</label>
                        <input type="text" id="cin" name="cin" class="form-control" required>
                        @if ($errors->has('cin'))
                            <span class="text-danger">{{ $errors->first('cin') }}</span>
                        @endif
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" class="form-control" required>
                        @if ($errors->has('nom'))
                            <span class="text-danger">{{ $errors->first('nom') }}</span>
                        @endif
                    
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" required>
                        @if ($errors->has('prenom'))
                            <span class="text-danger">{{ $errors->first('prenom') }}</span>
                        @endif
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    
                        <label for="tel">Téléphone:</label>
                        <input type="text" id="tel" name="tel" class="form-control" required>
                        @if ($errors->has('tel'))
                            <span class="text-danger">{{ $errors->first('tel') }}</span>
                        @endif
                    
                        <label for="adresse">Adresse:</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" required>
                        @if ($errors->has('adresse'))
                            <span class="text-danger">{{ $errors->first('adresse') }}</span>
                        @endif
                    
                        <label for="password">Mot de passe:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    
                        <label for="password_confirmation">Confirmer le mot de passe:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-register btn-block text-center">Inscription</button>
                   
                        <a href="{{ route('personne.login') }}" style="color: #000;" class="text-center">Déjà inscrit? Connectez-vous ici</a>
                 </div></form>
            </div></div>
        </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
