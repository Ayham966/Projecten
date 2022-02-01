@extends('admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
{{--                    <div class="card-header">--}}
{{--                        Create Products--}}
{{--                        <a href="{{ route('products.create') }}" class="btn btn-primary float-right">Create products</a>--}}
{{--                    </div>--}}

                    <div class="card-body">

                        {{--                        @include('partials.alerts')--}}

                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Product Name:</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">Product Description:</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
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
                                <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" id="price" placeholder="Enter price" name="price" min="1" maxlength="5">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="quantity">Product Quantity:</label>
                                <input onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" min="1" maxlength="5">
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="category_id">Select Category:</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
