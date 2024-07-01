@extends('layouts.adminauthLayouts')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Réinitialisation du mot de passe</h1>
        </div>
        <div class="body">
            <p>Bonjour !</p>
            <p>Nous avons reçu une demande de réinitialisation de votre mot de passe. Pour continuer, cliquez sur le bouton
                ci-dessous :</p>
            <a href="{{ route('admin_password_reset', ['token' => $token]) }}" class="reset-link">Réinitialiser</a>
            <p class="note">Si vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer cet e-mail
                en toute sécurité.</p>
        </div>
        <div class="footer">
            <p class="signature">Cordialement</p>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: auto;
            text-align: center;
        }

        .header h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .body p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .reset-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .reset-link:hover {
            background-color: #0056b3;
        }

        .note {
            color: #999;
            font-size: 14px;
        }

        .signature {
            font-style: italic;
            color: #999;
            margin-top: 40px;
        }
    </style>
@endsection
