<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Url;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        
        $urls = $user->urls()->paginate(10);
        
        $plans = Plan::get();
        
        return view('dashboard')->with(compact('user','urls','plans'));
    }

    public function shortCodeRedirection($short_code){
        
        $url = Url::whereShortUrl($short_code)->first();
        if(!$url){
            return abort(404);
        }

        return redirect()->to($url->original_url);
    }
}
