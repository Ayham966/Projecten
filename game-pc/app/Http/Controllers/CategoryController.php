<?php

namespace App\Http\Controllers;

//use App\Category;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        return view('categories.index')->with(compact(['categories','products']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

//        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        if($request->method()=='GET')
        {
            $categories = Category::all();
            return view('categories.create', compact('categories'));
        }
        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'name'      => 'required',
            ]);

            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->back()->with('success', 'Category has been created successfully.');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
  //      $category->parent_id = $request->parent_category ? $request->parent_category : 0;

        if ($category->save() ) {
            return redirect()->route('categories.index')->with(['message' => 'Category added successfully.']);
        }

        return redirect()->back()->with(['message' => 'Unable to add category.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit')->with(compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
  //      $category->parent_id = $request->parent_category ? $request->parent_category : 0;
        if ($category->save() ) {
            return redirect()->route('categories.index')->with(['message' => 'Category successfully updated.']);
        }

        return redirect()->back()->with(['message' => 'Unable to update category.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->back()->with(['message' => 'Category successfully deleted.']);
        }

        return redirect()->back()->with(['message' => 'Unable to delete category.']);
    }
}
