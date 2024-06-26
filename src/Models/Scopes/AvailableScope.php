<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Models\Scopes;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait AvailableScope
{
    public function scopeActive(Builder $builder): Builder
    {
        return $builder
            ->where('active_from', '<=', CarbonImmutable::now())
            ->where(function ($q): void {
                $q->where('expires_at', '>', CarbonImmutable::now())
                    ->orWhereNull('expires_at');
            });
    }

    public function scopeAvailable(Builder $builder): Builder
    {
        return $builder
            ->whereColumn('uses_max', '>', 'uses_current');
    }

    public function scopeForUser(Builder $builder, $user): Builder
    {
        return $builder->where('for_user_type', $user::class)
            ->where('for_user_id', $user->id);
    }

    public function scopeForEmail(Builder $builder, string $email): Builder
    {
        return $builder
            ->where('for_email', $email);
    }

    public function scopeForIp(Builder $builder, string $ip): Builder
    {
        return $builder
            ->where('for_ip', $ip);
    }
}
