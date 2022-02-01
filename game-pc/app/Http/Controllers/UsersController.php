<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\Category;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all()->except(Auth::id());
        return view('master.users', compact('users'));
    }

    public function edit(Request $request){
        $user = DB::table('users')->where('id', $request->id)->first();
        if ($user->role == "admin" )  {
            return view('master.editAdmin')->with(compact(['user']));
        } else {
            return view('master.editUser')->with(compact(['user']));
        }
    }
    public function editProfile(Request $request){
        $categories = Category::all();
        $user = DB::table('users')->where('id', $request->id)->first();
        return view('master.dashboard')->with(compact(['user','categories']));
    }

    public function update($id, UserEditRequest $request)
    {
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->nickname = $request->get('nickname');
        $user->role = $request->get('role');
        if ( Auth::user()->role == "user" ) {
            $user->role = 'user';
        }
        if ($user->save() ) {
            return redirect()->back()->with('message','Profile successfully updated!');
        } else {
            return redirect()->back()->with('message','Something went wrong!');
        }
    }

    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->back();
    }

    public function changePassword($id , Request $request)
    {
        if ( Auth()->user()->id != $id) {
            $request->validate([
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);
        } else {
            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);
        }

        User::find($id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->back()->with('message','Password successfully changed!');
    }


    public function deleteImage($id)
    {
        $user = User::find($id);
        Storage::delete('/public/images/'.$user->image);
        if ($user->save()) {
            $user->image = 'user.png';
            if ($user->save()) {
                return redirect()->back()->with('message','Image successfully deleted!');
            }
        }
    }

    public function destroy($id)
    {
        $delete_user = User::find($id);
        $delete_user->delete();
        return redirect()->back()->with('message','User successfully deleted!');
    }

}
