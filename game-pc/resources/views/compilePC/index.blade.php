@extends('layouts.app')

@section('title', 'Samenstellen')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <br>
        <h1 class="text-center text-muted">Samenstellen</h1>
        <form action="{{route('compile.success')}}" method="post">
            @csrf
            <div class="container p-3">
                @foreach( $categories as $category)
                    <div class="row w-75 mx-auto m-3 border border-1 border-dark rounded bg-light">
                            <h4 class="p-3">{{$category->name}}:</h4>
                                <div class="row col-6 mx-auto p-4">
                                    <select name="{{$category->id}}" class="p-3">
                                        <option selected disabled>Selecteer een product</option>
                                        @foreach( $category->product as $product)
                                            @if($product->quantity > 0)
                                                <option value="{{$product->id}}">{{$product->title}}  €<span class="products">{{$product->price}}</span></option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
{{--                                <div class="row col-2 mx-auto">--}}
{{--                                   <h5><span class="priceSelected"></span></h5>--}}
{{--                                </div>--}}
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="p-3 py-5">
                        @guest
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Persoonlijk gegevens:</h4>
                            </div>
                        @endguest
                        <div class="row mt-2">
                        </div>
                        <div class="row mt-3">
                            @guest
                                <div class="col-md-12">
                                    <label class="labels" for="name">Naam:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels" for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                            @endguest
                        </div>
                        <h4 class="mt-5">Adresgegevens:</h4>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels" for="city">Stad:</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="stad">
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            </div>
                            <div class="col-md-6">
                                <label class="labels" for="street">Straat:</label>
                                <input type="text" class="form-control" id="street" name="street" placeholder="straatnaam">
                                <span class="text-danger">{{ $errors->first('street') }}</span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels" for="postcode">Postcode:</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="postcode">
                                <span class="text-danger">{{ $errors->first('postcode') }}</span>
                            </div>
                            <div class="col-md-6">
                                <label class="labels" for="house">Huisnummer:</label>
                                <input type="text" class="form-control" id="house" name="house" placeholder="huisnummer">
                                <span class="text-danger">{{ $errors->first('house') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="<?php echo rand(2,5000)?>" name="compile">
            <div class="mt-5 p-3 text-center"><button class="btn btn-primary" type="submit">Bestellen</button></div>
            <br><br>
        </form>
    </div>

@endsection
