@extends('admin.admin')

@section('title', 'Categorieën')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary float-right">Categorie toevoegen</a>
                    </div>

                    <div class="card-body">

{{--                        @include('partials.alerts')--}}

                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Categorie Naam</th>
                                <th>Producten</th>
                                <th>Actie</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name}}</td>
                                    <td>{{ $category->product->count()}}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', ['category'=> $category->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                        <form action="{{ route('categories.destroy', ['category'=> $category->id]) }}" method="POST" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-xs btn-danger">Delete</button>
                                        </form>
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
