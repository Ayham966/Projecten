@extends('admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Edit Product
                        <a href="{{ route('products.create') }}" class="btn btn-primary float-right">Create Product</a>
                    </div>

                    <div class="card-body">
                        {{--                        @include('partials.alerts')--}}

                        <form action="{{ route('products.update', ['product'=>$product->id] ) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group">
                                <label for="title">Product Name:</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $product->title }}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">Product Description:</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" value="{{ $product->description }}">
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="image">Product image:</label>
                                <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="price">Product Price:</label>
                                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" min="1" maxlength="6" value="{{$product->price}}">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="quantity">Product Quantity:</label>
                                <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" value="{{$product->quantity}}">
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="category_id">Select Category:</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select a category</option>

                                    @foreach($categories as $category)
                                        @if($category->id === $product->category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
