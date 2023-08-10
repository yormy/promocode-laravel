<?php
namespace Yormy\PromocodeLaravel\Services;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\Exceptions\InvalidValueException;
use Yormy\PromocodeLaravel\Models\PromocodeStripe;

class PromocodeStripeService
{
    protected string $internalName;

    protected string $description;
    protected int $descriptionDiscountPercentage;
    protected int $descriptionDiscountAmountCents;

    protected int $maxUses;
    protected CarbonImmutable $activeFrom;

    protected CarbonImmutable $expiresAt;

    protected string $stripeCouponId;

    public function generate(): self
    {
        $this->code = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE);

        return $this;
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

    public function stripeCouponId(string $stripeCouponId): self
    {
        $this->stripeCouponId = $stripeCouponId;

        return $this;
    }


    public function create(string $code = null): PromocodeStripe
    {
        if (!$code) {
            $code = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE,7);
        }

        $data = [
            'code' => $code,
            'max_uses' => $this?->maxUses ?? 1,
            'stripe_coupon_id' => $this->stripeCouponId,
        ];

        if (isset($this->expiresAt)) {
            $data['expires_at'] = $this->expiresAt;
        }

        if (isset($this->activeFrom)) {
            $data['active_from'] = $this->activeFrom;
        }

        if (isset($this->internalName)) {
            $data['internal_name'] = $this->internalName;
        }

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->descriptionDiscountAmountCents) && isset($this->descriptionDiscountPercentage) ) {
            throw new InvalidValueException('Cannot set discount in Percentage AND in Amount');
        }

        if (isset($this->descriptionDiscountPercentage)) {
            $data['description_discount_percentage'] = $this->descriptionDiscountPercentage;
        }

        if (isset($this->descriptionDiscountAmountCents)) {
            $data['description_discount_amount_cents'] = $this->descriptionDiscountAmountCents;
        }
        return PromocodeStripe::create($data);
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

    public function descriptionDiscountPercentage(int $descriptionDiscountPercentage): self
    {
        $this->descriptionDiscountPercentage = $descriptionDiscountPercentage;

        return $this;
    }

    public function descriptionDiscountAmountCents(int $descriptionDiscountAmountCents): self
    {
        $this->descriptionDiscountAmountCents = $descriptionDiscountAmountCents;

        return $this;
    }
}
