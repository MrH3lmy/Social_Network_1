<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Status;

class HomeController extends Controller 
{
    public function index()
    {   
        if(Auth::check()){
            $statuses = Status::notReply()->where(function($query){
                return $query->where('user_id',Auth::user()->id)
                ->orWhereIn('user_id',Auth::user()->friends()->pluck('id'));
            }) ->orderBy('Created_at','desc')
                ->paginate(10);



            return view('timeline.index')->with('statuses',$statuses);
        }
        return view ('home');

    }

}