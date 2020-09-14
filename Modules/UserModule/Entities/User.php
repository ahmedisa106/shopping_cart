<?php

namespace Modules\UserModule\Entities;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'photo', 'password', 'phone', 'address'];

    protected $table = 'users';

}
