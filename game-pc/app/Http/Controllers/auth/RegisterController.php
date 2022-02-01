<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
       $this->middleware(['guest']);
    }

    public function index()
    {
        $categories = Category::all();
        return view('auth.register')->with(compact(['categories']));
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|max:255',
            'nickname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('home');
    }

}
