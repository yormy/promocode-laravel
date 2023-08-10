<?php

namespace Yormy\PromocodeLaravel\Tests\Setup\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'email',
    ];

    public $timestamps = false;
}
