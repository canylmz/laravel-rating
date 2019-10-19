<?php

namespace Canylmz\Rating\Test\Models;

use Canylmz\Rating\CanBeRated;
use Canylmz\Rating\Contracts\Rateable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Rateable
{
    use CanBeRated;

    protected $fillable = [
        'name',
    ];
}
