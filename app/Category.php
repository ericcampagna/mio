<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function part()
    {
    	return $this->hasMany('App\Part');
    }

    public function children() {
    return $this->hasMany('Category','parent');
	}

	public function parent() {
	    return $this->belongsTo('Category','parent');
	}

	
}
