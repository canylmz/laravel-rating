<?php

namespace Canylmz\Rating\Test\Models;

use Canylmz\Rating\Rate;
use Canylmz\Rating\Contracts\Rating;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements Rating
{
    use Rate;

    protected $fillable = [
        'name',
    ];
}
