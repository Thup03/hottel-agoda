<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = [
		'id', 
		'title', 
		'thumbnail', 
		'description', 
		'content', 
		'slug', 
		'category_id', 
		'qty',
		'avaiable',
		'booked',
		'no_bed',
		'bed_type',
		'facility',
		'price',
		'view_count',
	];

	public function categories()
	{
		return $this->belongsTo('App\Category', 'category_id');
	}
}
