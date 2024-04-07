<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Database\Factories;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\Xid\Services\XidService;

abstract class PromocodeFactory extends Factory
{
    public function definition()
    {
        return [
            'xid' => XidService::generate(),

            'internal_name' => $this->faker->word,
            'code' => PromocodeInvite::generate(),
            'description' => $this->faker->text(100),
            'active_from' => Carbon::now(),
            'expires_at' => null,
            'uses_max' => 1,

            'for_user_id' => null,
            'for_user_type' => null,
            'for_email' => null,
            'for_ip' => null,
        ];
    }

    public function code(string $code): Factory
    {
        return $this->state(function () use ($code) {
            return [
                'code' => $code,
            ];
        });
    }

    public function activeFrom(CarbonImmutable $activeFrom): Factory
    {
        return $this->state(function () use ($activeFrom) {
            return [
                'active_from' => $activeFrom,
            ];
        });
    }

    public function expired(): Factory
    {
        return $this->state(function () {
            return [
                'expires_at' => Carbon::now()->subDay(1),
            ];
        });
    }

    public function maxUses(): Factory
    {
        return $this->state(function (int $uses) {
            return [
                'uses_max' => $uses,
            ];
        });
    }

    public function activated(): Factory
    {
        return $this->state(function () {
            return [
                'activated_at' => Carbon::now()->subDay(1),
            ];
        });
    }

    public function forUser($userCode): Factory
    {
        return $this->state(function () use ($userCode) {
            return [
                'for_user' => $userCode,
            ];
        });
    }

    public function forEmail(string $email): Factory
    {
        return $this->state(function () use ($email) {
            return [
                'for_email' => $email,
            ];
        });
    }

    public function forIp(string $ipAddress): Factory
    {
        return $this->state(function () use ($ipAddress) {
            return [
                'for_ip' => $ipAddress,
            ];
        });
    }
}
