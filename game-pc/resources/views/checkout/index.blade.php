@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
            <form action="{{route('checkout.success')}}" method="post">
                @csrf
                <div class="row">
                    <div class="row">
                        <div class="col-md-6">
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
                                        <input onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  type="text" class="form-control" id="house" name="house" placeholder="huisnummer" maxlength="4">
                                        <span class="text-danger">{{ $errors->first('house') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="row p-3 py-3 border border-1 bg-light shadow p-3 mb-5 rounded">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Order:</h4>
                                </div>
                                <div class="col-3">
                                    <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    <span class="text-danger">{{ $errors->first('product_id') }}</span>
                                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                <img class="rounded-circle mt-1 border border-dark" width="200" height="200" src="/storage/products/{{ $product->image }}">
                                </div>
                                <div class="col-2"> </div>
                                <div class="col-7">
                                    <ul class="list-group list-group-flush h6">
                                        <h6>Naam:</h6>
                                        <li class="list-group-item border border-1 rounded  bg-transparent h6"><b class="text-muted">{{$product->title}}</b></li>
                                        <br>
                                        <h6>Over product:</h6>
                                        <li class="list-group-item  border border-1 rounded bg-transparent h6"><b class="text-muted">{{$product->description}}</b></li>
                                        <br>
                                        <h6>Prijs per stuk:</h6>
                                        <li class="list-group-item border border-1 rounded w-50 bg-transparent h6"><b class="text-muted" id="itemPrice">${{$product->price}}</b></li>
                                        <br>
                                        <h6> <label for="count">Aantal:</label></h6>
                                         <input class="list-group-item  border border-1 rounded w-50" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="1" type="number" pattern="[0-9]+" name="amount" id="amount" min="1" max="{{$product->quantity}}" maxlength="1">
                                        <p class="text-muted p-1">Maximaal: 9</p>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="row w-75 mx-auto">
                            <div class="col-8"></div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo rand(2,5000)?>" name="compile">
                    <div class="mt-5 p-3 text-center"><h5 class="bg-light w-25 mx-auto shadow p-3 rounded">Totaal: $<b id="total">{{$product->price}}</b></h5></div>
                    <div class="mt-5 p-3 text-center"><button class="btn btn-primary" type="submit">Bestellen</button></div>
                    <br><br>
                </div>
            </form>
    </div>

    <script>
        let itemPrice = {{$product->price}};
        let count = document.getElementById("amount");
        let total = document.getElementById("total");
        let totalBlade = document.getElementById("total");

        count.addEventListener('onkeydown' , (e) => {
            let changeTotal = e.target.value * itemPrice;
            return total.textContent = changeTotal.toString();
        });


        count.addEventListener('input' , (e) => {
            let changeTotal = e.target.value * itemPrice;
            return total.textContent = changeTotal.toString();
        });

    </script>
@endsection
