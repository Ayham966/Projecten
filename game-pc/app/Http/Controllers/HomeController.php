<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('master.index')->with(compact(['categories']));
    }

    public function showProducts($name)
    {
        $categories = Category::all();
        $cate = Category::where('name', $name)->get();
        $products = Product::where('category_id', $cate[0]->id)->get();
        return view('master.categoryProduct')->with(compact(['cate','products','categories']));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('/admin.admin');
    }
}
