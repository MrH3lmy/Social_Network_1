<?php

namespace App\Http\Controllers;


use Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ProfileController extends Controller 
{
    public function getProfile($username)
    {   
        $user = User::where('username',$username)->first();

        if(!$user){
            abort(404);

        }
        return view('profile.index')
        ->with('user',$user);

    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){

        $this-> validate($request,[
            'firstname' => 'max:50',
            'lastname' => 'max:50',
            'location' => 'max:20',

        ]);

        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),


        ]);

        return redirect()
        -> route('profile.edit')
        -> with('info','Your Profile has been updated');

    }

}