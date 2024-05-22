<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slides';
	protected $fillable  = [
		'name', 'image', 'display_order', 'link', 'description', 'sponsor', 'createby', 'status'
	];
}
