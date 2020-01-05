<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'ID';
	
	public $timestamps = false;
	
	protected $guarded =[];

}
