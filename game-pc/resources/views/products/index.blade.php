@extends('admin.admin')

@section('title', 'Producten')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('products.create') }}" class="btn btn-primary float-right">Product toevoegen</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Afbeelding</th>
                                <th>Naam</th>
                                <th>Beschrijven</th>
                                <th>Prijs</th>
                                <th>Vooraad</th>
                                <th>Categorie</th>
                                <th>Actie</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="/storage/products/{{$product->image}}" class="card-img-top" alt="...">
                                    </td>
                                    <td>{{ $product->title}}</td>
                                    <td>{{ $product->description}}</td>
                                    <td>€{{ $product->price}}</td>
                                    @if($product->quantity > 10)
                                        <td class="text-primary h5">{{ $product->quantity}}</td>
                                    @else
                                    <td class="text-danger h5">{{ $product->quantity}}</td>
                                    @endif
                                    <td>{{ !empty($product->category->name) ? $product->category->name : ""}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-5">
                                                <a href="{{ route('products.edit', ['product'=> $product->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                            </div>
                                            <div class="col-5">
                                                <form action="{{ route('products.destroy', ['product'=> $product->id]) }}" method="POST" style="display: inline-block;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
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
