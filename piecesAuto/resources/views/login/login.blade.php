<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://th.bing.com/th/id/R.4fc69409e66323a20fa971e02f596a85?rik=uAkxXtIN1Qu7Yw&pid=ImgRaw&r=0');
            color: #ffffff; 
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: rgba(15, 15, 15, 0.742); 
            color: hsl(0, 0%, 100%); 
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(243, 5, 5, 0.993);
            padding: 30px;
            animation: slideInFromLeft 1s ease forwards;
            margin-top: 10%;
        }
        h1 {
            color: #c; /* Rouge */
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-control {
            background-color: #00000096; 
            border-color: rgba(255, 255, 255, 0.2); 
            color: #881313; 
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-danger {
            background-color: rgba(243, 5, 5, 0.993); 
            border-color: #dc3545; 
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            float: right;
            transition: background-color 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #c82333; 
            border-color: #c82333; 
        }
        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-50%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-sm-6 mx-auto text-center">
                <div class="form-container">
                    <div>
                        <h1>Connexion Adminstrateur</h1>
                    </div>
                    <form action="{{ route('login.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" name="email" required autofocus class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="mdp" type="password" name="mdp" required class="form-control" placeholder="Mot de passe">
                        </div>
                        <button type="submit" class="btn btn-danger">Se connecter</button>
                        <br>
                    </form>
                    @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
