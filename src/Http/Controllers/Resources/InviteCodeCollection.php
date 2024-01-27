<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Http\Controllers\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InviteCodeCollection extends ResourceCollection
{
    public $collects = InviteCodeResource::class;
}
