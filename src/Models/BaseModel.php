<?php

namespace Yormy\PromocodeLaravel\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

/**
 * Yormy\PromocodeLaravel\Models\BaseModel
 *
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use Prunable;

    public function redeem()
    {
        $this->increment('current_uses');
    }

    public function prunable(): Builder
    {
        return static::whereColumn('max_uses', '=<', 'current_uses')
            ->orWhere('expires_at', '<', now());
    }
}
