@extends('layouts.app')

@section('title', 'Checkout-success')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5 p-5">
        <div class="text-center mt-3 p-5">
            <h2 class="text-center text-success mt-3">Bestellen gelukt!</h2>
            <img class="mx-auto" src="/images/success.png" width="50" height="50" alt="success">
            <br>
        </div>
        <div class="text-center mt-3 p-5">
            <p class="mx-auto">U ontvangt een e-mail met alle aankoopgegevens!</p>
        </div>
    </div>
@endsection
