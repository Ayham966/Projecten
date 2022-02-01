<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class ContactUsController extends Controller
{
    public function createForm(Request $request)
    {
        $categories = Category::all();


        return view('auth.contact')->with(compact(['categories']));


    }

    public function ContactUsForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create($data);
        return back()->with('success', 'We hebben uw bericht ontvangen');

    }

    public function index()
    {
        $messeges = Contact::all();
        return view('master.contact', compact('messeges'));
    }

    public function destroy($id)
    {
        $d_messege = Contact::find($id);
        $d_messege->delete();
        return redirect()->back()->with('status', 'Bericht Verwijdert!');
    }
}
