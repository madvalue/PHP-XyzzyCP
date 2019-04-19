<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>{{ env("APP_NAME") }}</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
        <style>
            nav.navbar {
                padding: 0 1rem;
                height: 50px;
            }
            div.container-fluid {
                height: calc(100vh - 50px);
            }
            div.row {
                height: 100%;
            }
            div.main {
                height: 100%;
                padding: 15px 25px;
                overflow: auto;
            }
            @media screen and (max-width:570px) {
                div.main {
                    overflow: hidden;
                    height: auto;
                    padding: 15px 11px;
                }
            }
            ul.nav {
                margin-left: -10px;
            }
            .nav-link.active {
                color: #007bff;
            }
            .nav-link {
                color: #2c3e50;
            }

            .stat-card {
                display: inline-block;
                margin-right: 15px;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-2 bg-light d-none d-sm-block">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link {{ $page == 'main' ? 'active' : '' }}" href="{{ env('APP_URL') }}">Strona główna</a></li>
                        <li class="nav-item"><a class="nav-link {{ $page == 'characters' ? 'active' : '' }}" href="{{ env('APP_URL') }}/characters">Lista postaci</a></li>
                        <li class="nav-item"><a class="nav-link {{ $page == 'characters_new' ? 'active' : '' }}" href="{{ env('APP_URL') }}/characters/new">Nowa postać</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ env('APP_URL') }}/logout">Wyloguj się</a></li>
                        <div class="border-bottom mt-1"></div>
                    </ul>
                </div>
                <div class="col main">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
                    @elseif(session("success_message"))
                        <div class="alert alert-success" role="alert">{{ session("success_message") }}</div>
                    @endif
                    
                    @yield('content')
                    <br><br>
                </div>
            </div>
        </div>
    </body>
</html>