<?php

namespace Yormy\PromocodeLaravel\Models;


abstract class PromoCode extends BaseModel
{
    protected $fillable = [
        'code'
    ];
}
