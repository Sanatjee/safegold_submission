<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSubscriptionRequest;


class SubscriptionsController extends Controller
{
    
    public function store(StoreSubscriptionRequest $request)
    {
        $validatedData = $request->validated();

        
        $store = Subscription::create(
            [
                "user_id" => Auth::user()->id,
                "plan_id" => $validatedData['plan_id'],
            ]
        );

        if(!$store){
            return redirect()->back()->with('error',config('webresponse.generic_error'));
        }

        return redirect()->route('dashboard')->with('success',config('webresponse.subscription_upgrade'));
    }

}
