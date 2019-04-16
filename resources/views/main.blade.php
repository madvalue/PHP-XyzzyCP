@extends('layouts.main')

@section('content')
    @if ($account->success == false)
        <div class="alert alert-danger" role="alert">
            {{ $account->message }}
        </div>
    @else
        <h3>Witaj ponownie, <i>{{ $account->data->login }}</i>!</h3>

        <hr>

        <div class="card stat-card" style="width:16rem;">
            <div class="card-body">
                <h5 class="card-title">
                    @if ($account->data->quiz == 1)
                        <span class="text-success">Zaliczony</span>
                    @else
                        <span class="text-danger">Niezaliczony</span>
                    @endif
                </h5>
                <h6 class="card-subtitle text-muted">Stan quizu RP</h5>
            </div>
        </div>

        <div class="card stat-card" style="width:16rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $account->data->gp }}</h5>
                <h6 class="card-subtitle text-muted">GamePoints</h5>
            </div>
        </div>

        <div class="card stat-card" style="width:16rem;">
            <div class="card-body">
                <h5 class="card-title">brak</h5>
                <h6 class="card-subtitle text-muted">Konto premium</h5>
            </div>
        </div>

        <div class="card stat-card" style="width:16rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $account->data->registered }}</h5>
                <h6 class="card-subtitle text-muted">Data rejestracji</h5>
            </div>
        </div>

        <div class="card stat-card" style="width:16rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $account->data->character_limit }}</h5>
                <h6 class="card-subtitle text-muted">Limit postaci</h5>
            </div>
        </div>
    @endif
@endsection