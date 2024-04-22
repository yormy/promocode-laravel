<?php

declare(strict_types=1);

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
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use Prunable;

    public function prunable(): Builder
    {
        return static::whereColumn('uses_max', '=<', 'uses_current')
            ->orWhere('expires_at', '<', now());
    }
}
