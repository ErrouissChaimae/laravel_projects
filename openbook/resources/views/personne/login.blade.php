<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Personne</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Base styles */
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

        /* Card styles */
        .card {
            border: none;
            box-shadow: 0 4px 8px #e2c6a2;
            border-radius: 10px;
            overflow: hidden;
            animation: fadeInUp 0.5s ease forwards;
            width:100%;
            margin-top: -70%;
            text-align: left;

        }

        .card-header {
            background-color: #fde6cb;
            color: #af670ac5;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        /* Form styles */
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

        /* Button styles */
        .btn-login {
            background-color: #af670ac5;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #c49a58;
        }

        /* Error message styles */
        .text-danger {
            color: #ff0000;
        }

        /* Animation */
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
    <center>
    <div class="container_fluid" style=" border-radius: 10px;min-height:588px;
    ;width: 90%;box-shadow:0px 4px 8px rgba(0, 0, 0, 0.219);margin-top:2.5%;background: linear-gradient(to right, #FDEBD7 , #f8f5f18f );">
        <div class="row">
            <div class="col-md-6">
                <img src="/images/loginc.png" style="width: 105%;">
            </div>
            <div class="col-md-6" style="width:%;margin-left:500px;
">
                <div class="card">
                    <div class="card-header">
                        <h3>Connexion</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('personne.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-login btn-block">Connexion</button>
                            
                                <a href="{{ route('personne.register') }}" style="color: #000;">Pas encore inscrit? Créer un compte</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </center>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
