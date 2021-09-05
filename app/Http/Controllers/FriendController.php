<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class FriendController extends Controller 
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index')
        ->with('friends', $friends )
        ->with('requests', $requests );

    }

    public function getAdd($username){
       
        $user = User::where('username',$username)->first();

        if (!$user) { 

            return redirect()
            ->route('home')
            ->with('info','That user could not be found');

        }

        if(Auth::user()->id === $user->id){
            return redirect()
            ->route('home');
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->
        hasFriendRequestPending(Auth::user())){
            return redirect()
            ->route('profile.index',['username' =>$user->username])
            ->with('info','Friend Request already Pending');
        }



        if(Auth::user()->isFriendsWith($user)){
            return redirect()
            ->route('profile.index',['username' =>$user->username])
            ->with('info','you are  already Friends');
        }

        if(Auth::user()->addFriend($user)){

        return redirect()
            ->route('profile.index',['username' =>$username])
            ->with('info','Friend Request Sent');}
    }

    public function getAccept($username){
        $user = User::where('username',$username)->first();

        if (!$user) { 

            return redirect()
            ->route('home')
            ->with('info','That user could not be found');

        }



        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()
            ->route("home");
            
        }

        Auth::user()->acceptFriendRequest($user);
        return redirect()
        ->route('profile.index',['username' =>$username])
        ->with('info','Friend Request Accepted.');


        if(!Auth::user()->hasFriendRequestPending($user) || $user->
        hasFriendRequestPending(Auth::user())){
            return redirect()
            ->route("home");
            
        }

        

    
    
    }

}