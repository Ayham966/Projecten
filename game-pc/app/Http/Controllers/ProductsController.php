<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $this->data['products'] = Product::all();
        return view('products.index', $this->data);
    }

    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('products.create', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title'            => 'required',
            'description'      => 'required',
            'image'            => 'nullable',
            'price'            => 'required|numeric',
            'quantity'         => 'required|numeric',
            'category_id'      => 'nullable|numeric'
        ]);
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('products',$filename,'public');
            $validator['image'] = $filename;
        }

        if( Product::create($validator) ) {
            return redirect()->route('products.index')->with('message','Product successfully created!');
        }
        return redirect()->route('products.index')->with('message','Product successfully created!');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit')->with(compact(['product', 'categories']));
    }

    public function update(ProductRequest $request, $id)
    {
        $data                   = $request->all();
        $product                = Product::find($id);
        $product->category_id   = $data['category_id'];
        $product->title         = $data['title'];
        $product->description   = $data['description'];
        $product->price         = $data['price'];
        $product->quantity      = $data['quantity'];

        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            if ($request->image->storeAs('products',$filename,'public')) {
                Storage::delete('/public/products/'.$product->image);
                $product->save();
            }
            $data['image'] = $filename;
            $product->image         = $data['image'];
        }

        if( $product->save() ) {
            Session::flash('message', 'Product Updated Successfully');
        }

        return redirect()->to('products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if( Product::destroy($id) ) {
            Storage::delete('/public/products/'.$product->image);
            Session::flash('message', 'Product Deleted Successfully');
        }

        return redirect()->to('products');
    }
}
