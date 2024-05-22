<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $table = 'reservations';

	protected $fillable = [
		'id', 
		'room_id', 
		'phone', 
		'name', 
		'check_in_at', 
		'check_out_at', 
		'status',
		'user_id',
	];

	public function rooms(){
		return $this->belongsTo('App\Room', 'room_id');
	}
}
