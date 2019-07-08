<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Forrest;
use Session;
use Auth;
use App\User;

class Login extends Controller
{
    public function checkUser() {
    	Forrest::callback();
    	$identity = Forrest::identity();
    	Session::put('user_data', $identity);
    	$user = User::where('id', $identity['user_id'])
    			->where('IsActive', 1)
    			->first();
    	if($user)
    	{
    		Auth::login($user);
    		return redirect()->intended('start');
    	}
    	else
    	{
    	    return redirect('/')->with('message', 'Your Salesforce account does not appear to be linked. Please contact IT Dept');
    	}	

    }
}
