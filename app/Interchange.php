<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interchange extends Model
{
    public function part()
    {
    	return $this->belongsTo('App\Part');
    }
}
