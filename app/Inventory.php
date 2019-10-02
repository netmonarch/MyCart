<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = [];
	protected $table = 'inventories';

	public function category ($id)
	{
		return Category::find($id);
	}
}
