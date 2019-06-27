<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
	public function category_tree($id)
	{
		$tree = (object)[];
		$tree->line = $this->get_category($id);
		$tree->cat = $this->get_category($tree->line->parent_id);
		$tree->maxCat = $this->get_category($tree->cat->parent_id);
		$tree->minCat = $this->get_category($tree->maxCat->parent_id);

		return $tree;
	}
   

   public function get_category($cat_id)
   {
   		return Category::find($cat_id);
   }

   public function interchange()
   {
   		return $this->hasMany('App\Interchanges');
   }

}
