<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à votre compte yallarkab</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .custom-hr {
            border: 0;
            height: 3px;
            background-color: #ff9500;
            width: 50%;
            margin: 0 auto; 
        }
         


        .fd:hover i{
            padding-left: 5px;
            fill: #ff5a01;
            color: #ff5a01;

        } 
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-6">
            <div class="container">
                <h5>Connexion à votre compte yallarkab</h5>
                <span style="font-size: small;">Pour accéder à votre compte, gérer vos réservations et profiter de nos offres exclusives, veuillez saisir vos identifiants de connexion dans le formulaire.</span>
                <br><br>
                <hr class="custom-hr">
                <br>
                <p style="font-size: small;">Si vous n'avez pas encore de compte, n'hésitez pas à vous inscrire et rejoindre notre communauté de voyageurs satisfaits.</p>
            </div>
        </div>
        <div class="col-md-6">
            <form id="loginForm">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="email">Email<span style="color: rgb(233, 88, 4)">*</span></label>
                        <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus placeholder="Entre votre email">
                        <p id="emailError" class="error-message d-none"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="password">Mot de passe <span style="color: rgb(255, 88, 4)">*</span></label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Entre votre mot de passe">
                        <p id="passwordError" class="error-message d-none"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn" style="background-color: rgb(255, 133, 27); color: rgb(255, 255, 255);">
                            Se connecter
                        </button>
                        <a href="{{ route('register.client') }}" class="fd" style="color: #ff851b">
                            S'inscrire
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <p id="loginError" class="error-message d-none mt-3"></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
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
</body>
</html>
