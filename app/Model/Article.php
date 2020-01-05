<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'article';
	protected $primaryKey = 'ID';
	
	public $timestamps = false;
	
	protected $guarded =[];

}
