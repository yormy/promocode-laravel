<?php

namespace Yormy\PromocodeLaravel\Models\Scopes;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait AvailableScope
{
    public function scopeActive(Builder $builder): Builder
    {
        return $builder
            ->where('active_from', '<=', CarbonImmutable::now())
            ->where(function ($q) {
                $q->where('expires_at', '>', CarbonImmutable::now())
                    ->orWhereNull('expires_at');
            });
    }

    public function scopeAvailable(Builder $builder): Builder
    {
        return $builder
            ->whereColumn('max_uses', '>', 'current_uses');
    }

    public function scopeForUser(Builder $builder, $user): Builder
    {
        return $builder->where('for_user_type', get_class($user))
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
