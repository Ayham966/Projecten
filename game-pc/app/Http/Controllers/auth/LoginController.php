<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        $categories = Category::all();
        return view('auth.login')->with(compact(['categories']));
    }

    protected function store(Request $request)
    {

        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Inlog informatie niet correct!');
        }
        if (auth()->user()->role == 'admin') {
            return redirect()->route('adminPage');
        }
        return redirect()->route('home');

    }

}
