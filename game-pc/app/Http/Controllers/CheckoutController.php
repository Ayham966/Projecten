<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('checkout.index')->with(compact(['categories','product']));
    }

    public function indexAdmin()
    {
        $checkouts = Checkout::all();
        return view('master.showHistory')->with(compact(['checkouts']));
    }
    public function indexUser()
    {
//        $checkouts = Checkout::firstOrFail()->where('user_id', auth()->user()->id);
        $categories = Category::all();
      //  $checkouts =  Checkout::where("user_id", auth()->user()->id);
        $checkouts = Checkout::where('user_id', auth()->user()->id)->get();
        return view('master.showHistoryUser')->with(compact(['checkouts','categories']));
    }

    public function indexCompiling()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('compilePC.index')->with(compact(['categories','products']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( Auth::check()) {
            $validator = $request->validate([
                'name' => 'nullable|max:255',
                'email' => 'nullable|email|max:255',
                'city' => 'required|max:255',
                'postcode' => 'required|max:255',
                'street' => 'required|max:255',
                'compile' => 'required|max:5001|numeric',
                'house' => 'required|max:1500|numeric',
                'amount' => 'required|max:255|numeric',
                'product_id' => 'required|max:255|numeric',
                'user_id' => 'nullable|max:255|numeric',
            ]);
            $validator['user_id'] = auth()->user()->id;
        } else {
            $validator = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'city' => 'required|max:255',
                'postcode' => 'required|max:255',
                'street' => 'required|max:255',
                'compile' => 'required|max:5001|numeric',
                'house' => 'required|max:1500|numeric',
                'amount' => 'required|max:255|numeric',
                'product_id' => 'required|max:255|numeric',
                'user_id' => 'nullable|max:255|numeric',
            ]);
        }

        if (is_numeric($request->input('house')) && is_numeric($request->input('amount'))){
            Checkout::create($validator);
            $id = DB::getPdo()->lastInsertId();;
            $checkout = Checkout::find($id);
            $categories = Category::all();

            // product quantity to lesser
            $product = Product::find($validator['product_id']);
            $product->quantity -= $validator['amount'];
            if ( $product->save() ) {
                return view('checkout.show', compact('checkout','categories'));
            }
        } else {
            return back()->withErrors('Error');
        }


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function compiling(Request $request)
    {
            if(Auth::check()) {
                $validator = $request->validate([
                    'name' => 'nullable|max:255',
                    'email' => 'nullable|email|max:255',
                    'city' => 'required|max:255',
                    'postcode' => 'required|max:255',
                    'street' => 'required|max:255',
                    'compile' => 'required|max:5001|numeric',
                    'house' => 'required|max:255|numeric',
                    'amount' => 'nullable|max:255|numeric',
                    'product_id' => 'nullable|max:255|numeric',
                    'user_id' => 'nullable|max:255|numeric',
                ]);
                $validator['user_id'] = auth()->user()->id;
            } else {
                $validator = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'city' => 'required|max:255',
                    'postcode' => 'required|max:255',
                    'street' => 'required|max:255',
                    'compile' => 'required|max:5001|numeric',
                    'house' => 'required|max:255|numeric',
                    'amount' => 'nullable|max:255|numeric',
                    'product_id' => 'nullable|max:255|numeric',
                    'user_id' => 'nullable|max:255|numeric',
                ]);
            }
            $validator['amount'] = 1;

            if (is_numeric($request->input('house'))) {

                foreach ($request->except('_token') as $key => $part) {
                    if (is_numeric($key)) {
                        $validator['product_id'] = (int)$part;
                        Checkout::create($validator);
                        // product quantity to lesser
                        $product = Product::find($validator['product_id']);
                        $product->quantity -= $validator['amount'];
                        $categories = Category::all();
                        $product->save();

                    }
                }
                return view('checkout.show', compact('categories'));
            }


    }


    public function destroy(Checkout $checkout)
    {
        if ($checkout->delete()) {
            return redirect()->back();
        }
    }
}
