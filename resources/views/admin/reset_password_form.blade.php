@extends('layouts.adminauthLayouts')

@section('content')
    <form action="{{ route('admin_reset_password_submit') }}" method="post" class="mt-4">
        @csrf
        <style>
            body {
                font-family: "Nunito", sans-serif;
                background-color: #f3f4f6;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            form {
                width: 400px;
                border-radius: 10px;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                background-color: #ffffff;
                padding: 30px;
            }

            input {
                width: 100%;
                padding: 12px;
                margin: 8px 0;
                border: 1px solid #d1d5db;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 14px;
                background-color: #f9fafb;
                transition: border-color 0.2s ease-in-out;
            }

            input:focus {
                outline: none;
                border-color: #60a5fa;
            }

            button {
                background-color: #2563eb;
                color: #ffffff;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.2s ease-in-out;
            }

            button:hover {
                background-color: #3b82f6;
            }

            .forgot-password {
                display: inline-block;
                text-decoration: none;
                color: #2563eb;
                font-size: 14px;
                transition: color 0.2s ease-in-out;
            }

            .forgot-password:hover {
                color: #3b82f6;
            }

            img.avatar {
                width: 40%;
                border-radius: 50%;
            }

            .container {
                padding: 16px;
            }

            span.psw {
                float: right;
                padding-top: 16px;
            }

            .password-input-container {
                position: relative;
            }

            #password {
                padding-right: 30px;
                /* Adjust this value based on the width of the icon */
            }

            #togglePassword {
                position: absolute;
                top: 50%;
                right: 5px;
                /* Adjust this value to control the distance from the right edge */
                transform: translateY(-50%);
                cursor: pointer;
                padding-right: 10px;
            }

            /* Change s for span and cancel button on extra small screens */
            @media screen and (max-width: 300px) {
                span.psw {
                    display: block;
                    float: none;
                }

                .cancelbtn {
                    width: 100%;
                }
            }
        </style>
        <label for="email"><b>Email</b></label>
        <input type="text" name="email" value="{{ $email }}" readonly>


        <label for="password"><b>Nouveau Mot de Passe</b></label>
        <div class="password-input-container">
            <input type="password" id="password" placeholder="Entrez le Nouveau Mot de Passe" name="password">
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="password"><b>Confirmez le Mot de Passe</b></label>
        <div class="password-input-container">
            <input type="password" id="password" placeholder="Confirmez le Nouveau Mot de Passe"
                name="password_confirmation">
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="hidden" name="token" value="{{ $token }}">

        <button type="submit">Réinitialiser</button>
    </form>
@endsection
{{-- @section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/loginForm.css') }}">
@endsection --}}
