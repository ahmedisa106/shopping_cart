<?php

namespace Modules\AdminModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = 'admin';
    protected $fillable = ['username','email','name'];

    protected $hidden =['password','rememberToken'];
}
