<?php

namespace Modules\UserModule\Entities;

use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\CartModule\Entities\Cart;

class User extends Authenticatable
{
    use Favoriteability;

    protected $fillable = ['name', 'email', 'photo', 'password', 'phone', 'address'];

    protected $table = 'users';

    public function carts()
    {

        return $this->hasMany(Cart::class, 'user_id');
    }

}
