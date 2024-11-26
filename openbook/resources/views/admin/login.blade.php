<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-form {
            margin-top: 4%;
            background-color: #f9f9f9;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.253);
            animation: slideUp 0.5s ease-in-out;
            margin-right: 100px;
        }

        @keyframes slideUp {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-form label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-form button:hover {
            background-color: #555;
        }

        .error-msg {
            color: #ff0000;
            font-size: 14px;
            margin-top: 10px;
        }

        .login-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        @font-face {
            font-family: 'Cursive';
            src: url('chemin_vers_votre_police/cursive.ttf') format('truetype');
            /* Remplacez 'chemin_vers_votre_police/cursive.ttf' par le chemin réel vers votre police de caractères */
        }

        h1 {
            font-style: italic;
            font-family:Kunstler Script, serif; /*/ Didot Caslon Bodoni*/
            font-size:5em;
            font-weight: bold; /* Ajout de cette ligne */
            margin-top: 5%;
            margin-right: 30px
        }
    </style>
</head>
<body>
    <div class="container-fluid" style=" border-radius: 10px;  background: linear-gradient(to right, #FDEBD7, #f8f5f18f); /* Dégradé de rouge à bleu de gauche à droite */

;width: 90%;box-shadow:0px 4px 8px rgba(0, 0, 0, 0.219);margin-top:2.5%;background-color:#ffffff">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center"><br>
                <img src="/images/adminl.png" alt="Admin Login" class="login-image">
            </div>
            <div class="col-md-8">
                <h1 >Connexion Administrateur</h1>
                <form method="POST" action="{{ route('admin.login') }}" class="login-form" >
                    @csrf
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
                @if($errors->any())
                    <div class="error-msg">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
