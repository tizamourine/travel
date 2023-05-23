<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="asset/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <form method="POST" id="signup-form" class="signup-form">
                    <h2>S'inscrire </h2>
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Nom"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Prénom"/>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-input" name="email" id="email" placeholder="Numero de téléphone"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Mot de passe"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                     <div class="form-group">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Confirmer mot de passe"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>J'accepte toutes les <a href="#" class="term-service">Conditions d'utilisation</a></label>
                    </div>
                    <div class="form-group">

                        <input type="submit" name="submit" id="submit" class="form-submit submit" value="S'inscrire"/>
                        <a href="#" class="submit-link submit">Se Connecter</a>
                        <input type="text" value="" name="CSRFToken" style="display:none"/>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>