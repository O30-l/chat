<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login_log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id', 'login_info', 'login_time'
    ];

}
