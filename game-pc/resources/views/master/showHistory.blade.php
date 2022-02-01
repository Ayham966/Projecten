@extends('admin.admin')

@section('title', 'Geschiedenis')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="m-0 text-center alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead class="bg-light">
                            <tr>
                                <th>Email besteller:</th>
                                <th>OrderNummer</th>
                                <th>Product Naam:</th>
                                <th>Aantal</th>
                                <th>Betaald</th>
                                <th>Datum</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($checkouts as $checkout)
                                <tr>
                                    <td>{{ $checkout->email ? : $checkout->user->email}}</td>
                                    <td>{{ $checkout->compile}}</td>
                                    <td>{{ $checkout->product->title}}</td>
                                    <td class="text-primary">{{ $checkout->amount}}</td>
                                    @if($checkout->amount > 1)
                                        <td class="text-success"> €
                                            @php
                                                $total =  $checkout->amount * $checkout->product->price;
                                                echo $total;
                                            @endphp
                                       </td>
                                    @else
                                        <td class="text-success"> € {{ $checkout->product->price }} </td>
                                    @endif
                                    <td>{{ $checkout->created_at}}</td>
                                    <td>
{{--                                        <form action="{{ route('checkout.destroy', ['checkout'=> $checkout->id]) }}" method="POST" style="display: inline-block;">--}}
{{--                                            @method('DELETE')--}}
{{--                                            @csrf--}}
{{--                                            <button class="btn btn-xs btn-danger">Delete</button>--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
