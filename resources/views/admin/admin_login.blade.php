<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/admin/loginForm.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/loginForm.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            box-sizing: border-box;
        }

        .title {
            font-family: 'Roboto', sans-serif;
            /* Taille de la police */
            color: #2c3e50;

            /* Bordure gauche colorée */
            margin-bottom: 30px;

            /* Coins arrondis */
            text-align: left;

            text-transform: uppercase;
            /* Texte en majuscules */
        }


        /* Insérez le CSS ici */
        .sign-up-list-item {
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            color: #333;
            background-color: #f4f4f4;
            margin-bottom: 10px;
            border-radius: 6px;
            border-left: 3px solid #007BFF;
            padding: 10px;
            width: 260px;
            height: 64px;
            font-weight: 500;
            font-size: 16px;
            display: flex;
            align-items: center;
        }



        h3+br {
            display: none;
        }

        .social-text {
            font-size: 12px;
        }

        .content {
            margin: 0 auto;
        }



        /* Style général pour les titres h2 avec la classe title */
    </style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('admin_login_submit') }}" method="post" class="sign-in-form"
                    style="margin: auto; height: 550px;">
                    @csrf
                    <h2 class="title">Connexion</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="email@example.com" required id="emailAdmin"
                            autocomplete="off" name="email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" required placeholder="" name="password" required />
                    </div>
                    <input type="submit" value="Login" class="btn solid" />

                    <span class="psw float-end forgot-password"> <a href="{{ route('admin_forget_password') }}"
                            style="color: #007BFF;"> Mot de passe oublié?</a></span>


                    {{-- <p class="social-text">Ou connectez-vous avec des plateformes sociales</p> --}}
                    {{-- <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> --}}
                </form>
                <form action="{{ route('register') }}" method="POST" class="sign-up-form"
                    style="margin: auto; height: 550px; padding: 15px;">
                    @csrf
                    <h2 class="title">À propos</h2>
                    {{-- <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Système de connexion sécurisé" required />
                    </div> --}}
                    <h3 class="sign-up-list-item">Système de connexion sécurisé. <div class="background-left-right">
                        </div>
                    </h3><br>
                    <h3 class="sign-up-list-item">Tableau de bord. <div class="background-left-right"></div>
                        <div class="background-left-right"></div>
                    </h3><br>
                    <h3 class="sign-up-list-item">Gestion des absences. <div class="background-left-right"></div>
                    </h3><br>
                    <h3 class="sign-up-list-item">Rapports et analyses. <div class="background-left-right"></div>
                    </h3>
                    {{-- <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" class="btn" value="Sign up" /> --}}
                    {{-- <p class="social-text">Ou connectez-vous avec des plateformes sociales</p> --}}
                    {{-- <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> --}}
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h2>À PROPOS</h2>
                    <p>
                        Voici un aperçu de ce que notre application a à offrir.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        À propos
                    </button>
                </div>
                <img src="{{ asset('img/2.svg') }}" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h2>Connectez-Vous</h2>
                    <p>
                        {{-- Connectez-Vous --}}
                    </p>
                    <button class="btn transparent" id="sign-in-btn" style="font-size:10px;">
                        Se Connecter
                    </button>
                </div>
                <img src="{{ asset('img/register.svg') }}" class="image" alt="" />
            </div>
        </div>
    </div>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
    </script>
</body>

</html>
