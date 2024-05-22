<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
	protected $fillable = ['id', 'title', 'thumbnail', 'description', 'content', 'slug', 'author', 'category_id', 'view_count'];

	public function categories(){
		return $this->belongsTo('App\Category', 'category_id');
	}

	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

	public function post_tags(){
		return $this->hasMany('App\PostTags');
	}

	// public function users(){
	// 	return $this->belongsToMany('App\User', 'comments', 'user_id', 'post_id');
	// }

	public static function users($post_id){
		$query = "SELECT admins.* FROM posts INNER JOIN admins ON posts.user_id = admins.id WHERE posts.id = ".$post_id;

		$data = DB::select($query);
		
		return $data;
	}
}
