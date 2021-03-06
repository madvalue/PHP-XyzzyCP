@extends('layouts.auth')

@section('content')
    <form method="POST" action="register/process" class="form-signin">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h1 class="h3 mb-3 font-weight-normal">Tworzenie konta</h1>

        @if ($errors->any())
            <p class="text-danger">{{ $errors->first() }}</p>
        @elseif (isset($error_message))
            <p class="text-danger">{{ $error_message }}</p>
        @elseif (session('success_message'))
            <p class="text-success">{{ session('success_message') }}</p>
        @endif

        <label for="inputUsername" class="sr-only">Nazwa użytkownika</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Nazwa użytkownika" required="" autofocus="">

        <label for="inputEmail" class="sr-only">Adres E-Mail</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adres E-Mail" required="" autofocus="">

        <label for="inputPassword" class="sr-only">Hasło</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Hasło" required="">
    
        <button class="btn btn-lg btn-primary btn-block mt-3 mb-3" type="submit">Utwórz konto</button>
        <a href="login">Powrót do logowania</a>
    </form>
@endsection