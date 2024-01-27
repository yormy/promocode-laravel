<?php

namespace Yormy\PromocodeLaravel\DataObjects;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class PromocodeDto
{
    protected string $internalName;

    protected string $description;

    protected int $maxUses;

    protected CarbonImmutable $activeFrom;

    protected CarbonImmutable $expiresAt;

    protected $user;

    protected string $email;

    protected string $ip;

    public static function make(): self
    {
        return new static;
    }

    public function maxUses(int $maxUses): self
    {
        $this->maxUses = $maxUses;

        return $this;
    }

    public function activeFrom(CarbonImmutable $activeFrom): self
    {
        $this->activeFrom = $activeFrom;

        return $this;
    }

    public function expiresAt(CarbonImmutable $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function expiresInDays(int $days): self
    {
        $this->expiresAt = CarbonImmutable::now(config('app.timezone'))->addDays($days)->endOfDay();

        return $this;
    }

    public function forUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function forEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function internalName(string $internalName): self
    {
        $this->internalName = $internalName;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function forIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function toArray(string $code = null): array
    {
        if (! $code) {
            $code = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 7);
        }

        $data = [
            'code' => $code,
            'uses_max' => $this?->maxUses ?? 1,
        ];

        if (isset($this->expiresAt)) {
            $data['expires_at'] = $this->expiresAt;
        }

        if (! isset($this->activeFrom)) {
            $this->activeFrom = CarbonImmutable::now();
        }
        $data['active_from'] = $this->activeFrom;

        if (isset($this->internalName)) {
            $data['internal_name'] = $this->internalName;
        }

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->user)) {
            $data['for_user_id'] = $this->user->id;
            $data['for_user_type'] = get_class($this->user);
        }

        if (isset($this->email)) {
            $data['for_email'] = $this->email;
        }

        if (isset($this->ip)) {
            $data['for_ip'] = $this->ip;
        }

        return $data;
    }
}
