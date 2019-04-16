@extends('layouts.main')

@section('content')
    @if(session('error_message'))
        <div class="alert alert-danger" role="alert">
            {{ session('error_message') }}
        </div>
    @else
        <script>
            window.location.href = "{{ env('APP_URL') }}";
        </script>
    @endif
@endsection