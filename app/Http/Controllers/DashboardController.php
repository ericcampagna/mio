<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Opportunity;
use App\Account;
use App\Contact;

class DashboardController extends Controller
{
    public function show()
    {
    	$userId = '0051K000007qwOiQAI';
    	$user = User::find($userId);

    	$opportunities = Opportunity::where('OwnerId', $user->id)->get();

    	foreach($opportunities as $opportunity)
    	{
    		$opportunity->account;
    		$opportunity->contact;
    	}
    	return view('sales');
    }
}
