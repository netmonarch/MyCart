<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
	
	public function owner ()
	{
		return $this->belongsTo(Category::class);
	}
}
