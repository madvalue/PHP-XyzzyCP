@extends('layouts.main')

@section('content')
    <style>
        .skin-model {
            width: 100px;
        }
    </style>

    <div class="media">
        <img src="{{ env('APP_URL') }}/images/skins/{{ $data->skin }}.png" class="skin-model mr-3" alt="Wygląd postaci">
        <div class="media-body">
            <h5 class="mt-3">{{ $data->imie }} {{ $data->nazwisko }}</h5>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row" class="w-25">Pieniądze</th>
                        <td>${{ $data->money }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25">Konto bankowe</th>
                        <td>${{ $data->bank_money }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25">Data urodzenia</th>
                        <td>{{ strlen($data->data_urodzenia) > 0 ? $data->data_urodzenia : "Nie sprecyzowano" }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="w-25">Czas gry</th>
                        <td>{{ $data->friendly_playtime }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection