@extends('layouts.app')

@section('title', 'Geschiedenis')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="m-0 text-center alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @auth
        <div class="container rounded mt-5 mb-5">
            <div class="row">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Product:</th>
                                            <th>Aantal:</th>
                                            <th>Ordernummer:</th>
                                            <th>Betalen:</th>
                                            <th>Datum</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($checkouts as $checkout)
                                            <tr>
                                                <td>{{ $checkout->product->title }}</td>
                                                <td class="text-primary">{{ $checkout->amount}}</td>
                                                <td>{{ $checkout->compile}}</td>
                                                <td class="text-success">€ {{ $checkout->product->price }}</td>
                                                <td>{{ $checkout->created_at}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    @endauth
@endsection
