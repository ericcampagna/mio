<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    public function account(){
    	return $this->belongsTo('App\Account', 'AccountId');
    }
    public function contact()
    {
    	return $this->belongsTo('App\Contact', 'ContactId');
    }
}
