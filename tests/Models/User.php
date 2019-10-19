<?php

namespace Canylmz\Rating\Test\Models;

use Canylmz\Rating\CanRate;
use Canylmz\Rating\Contracts\Rater;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Rater
{
    use CanRate;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
