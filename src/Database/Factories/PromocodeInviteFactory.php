<?php

namespace Yormy\PromocodeLaravel\Database\Factories;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\Xid\Services\XidService;

class PromocodeInviteFactory extends Factory
{
    protected $model = PromocodeInvite::class;

    public function definition()
    {
        return [
            'xid' => XidService::generate(),

            'internal_name' => $this->faker->word,
            'code' => CodeGenerator::generate(),
            'description' => $this->faker->text,
            'active_from' => null,
            'expires_at' => null,
            'max_uses' => 1,

            'for_user_id' => null,
            'for_user_type' => null,
            'for_email' => null,
            'for_ip' => null,
        ];
    }

    public function code(): Factory
    {
        return $this->state(function (string $code) {
            return [
                'code' => $code,
            ];
        });
    }

    public function activeFrom(CarbonImmutable $activeFrom): Factory
    {
        return $this->state(function ($activeFrom) {
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
                'max_uses' => $uses,
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
}
