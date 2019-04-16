@extends('layouts.main')

@section('content')
    @if($characters->success == false)
        <div class="alert alert-danger" role="alert">{{ $characters->message }}</div>
    @else
        @forelse($characters->data as $character)
            <div class="card stat-card text-center" style="width:16rem;">
                <img src="{{ env('APP_URL') }}/images/skins/{{ $character->skin }}.png" class="card-img-top w-50" />
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $character->imie }} {{ $character->nazwisko }}
                    </h5>
                    <h6 class="card-subtitle text-muted text-left">
                        <div class="text-center mb-3">
                            @if($character->accepted == 1)
                                Zaakceptowana
                            @else
                                Niezaakceptowana
                            @endif
                        </div>
                        <a href="{{ env('APP_URL') }}/characters/{{ $character->id }}" class="btn btn-outline-secondary w-100">Szczegóły</a>
                    </h6>
                </div>
            </div>
        @empty
            <div class="alert alert-primary" role="alert">
                Do twojego konta nie przypisano żadnej postaci
            </div>
        @endforelse
    @endif
@endsection