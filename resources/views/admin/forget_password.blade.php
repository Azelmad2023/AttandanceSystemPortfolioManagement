@extends('layouts.adminauthLayouts')

@section('title', 'Admin Forget Password')

@section('content')
    <form action="{{ route('admin_forget_password_submit') }}" method="post" class="mt-4">
        @csrf


        @session('error')
            <div class="alert alert-danger">
                {{ $value }}
            </div>
        @endsession
        @session('status')
            <div class="alert alert-success">
                {{ $value }}
            </div>
        @endsession

        <label for="email"><b>Veuillez entrer votre email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Réinitialiser</button>
        <span class="psw float-end forgot-password "> <i class="fa-solid fa-arrow-left-long"></i> <a
                href="{{ route('login_form') }}"> Retour</a></span>

    </form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/loginForm.css') }}">
@endsection
@section('fontawesomeLink')
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
@endsection


@section('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection
