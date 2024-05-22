<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    protected $table = 'introductions';
    protected $fillable = ['content'];
}
