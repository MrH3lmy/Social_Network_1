<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SearchController extends Controller 
{
    public function getResults(Request $request)
    {   $query = $request->query('query');
        if(!$query){
            return redirect()->route('home');
        }
        $users = User::where(DB::raw("CONCAT(first_name,' ',last_name)"),'LIKE',"%{$query}%")
        ->orWhere('username','LIKE',"%{$query}%")
        ->get();


        return view ('search.results')->with('users',$users);

    }

}