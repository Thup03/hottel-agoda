<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'avatar', 'name', 'birthday', 'gender', 'indetity_cart', 'phone_number', 'address', 'email', 'email_verified_at', 'password', 'remember_token', 'level', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lectures(){
        return $this->hasMany('App\Lecture');
    }

}
