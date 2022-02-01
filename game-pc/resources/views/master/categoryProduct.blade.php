@extends('layouts.app')

@section('title', 'Product')

@section('content')
    <div class="container-fluid p-3 bg-dark">
        <nav class="navbar navbar-expand-sm mx-auto cate-nave">
            <ul class="navbar-nav mx-auto">
                @foreach($categories as $category)
                    @if (  !$category->parent && $category->id !== $category->parent)
                        <a class="nav-link text-light" href="/category/{{ $category->name }}">{{ $category->name  }}</a>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link text-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> {{ $category->parent->name }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">{{ $category->name}} </a></li>
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="container-fluid products-overview bg-dark p-3" style="position: relative;">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach($products as $product)
            <div class="col">
                <div class="card-product">
                    <div class="card-title text-center text-success h4 p-3">{{$product->title}}</div>
                    <img src="/storage/products/{{$product->image}}" class="card-img-top" alt="product">
                    <div class="w-25 mx-auto text-center">
                        <span class="text-success h4">€{{$product->price}}</span>
                    </div>
                    <hr class="bg-black w-100">
                    <div class="card-body">
                        <p class="h6">- {{$product->description}}</p>
                        @if($product->quantity !== 0)
                        <div class="text-center mt-5"> <a href="{{ route('checkout', ['id'=> $product->id]) }}" class="btn btn-warning">Bestellen</a> </div>
                        @else
                            <div class="text-center text-danger my-4 h5"><i class="bx bx-no-entry"></i> Uitverkocht</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
