<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\DataObjects\Promocode\PromocodeDataResponse;

class DiscountCodeDataResponse extends PromocodeDataResponse
{
    use DiscountCodeTrait;

    public function __construct(
        public string $xid,
        public string $internal_name,
        public string $description,
        public ?string $code,

        public ?int $uses_max,
        public ?CarbonImmutable $active_from,
        public ?CarbonImmutable $expires_at,

        public string | int | null $for_user_id,
        public ?string $for_ip,
        public ?string $for_email,

        public int $uses_current,
        public int $uses_left,
        public bool $is_active,
        public bool $is_available,

        public CarbonImmutable | null $deleted_at,

        public ?int $description_discount_amount_cents,
        public ?int $description_discount_percentage,
        public string $stripe_coupon_id,
    ) {
    }

    public static function fromModel($model): self
    {
        $constuctorData = parent::constructorData($model);

        return new static(
            ...$constuctorData,

            description_discount_amount_cents: $model->description_discount_amount_cents,
            description_discount_percentage: $model->description_discount_percentage,
            stripe_coupon_id: $model->stripe_coupon_id,
        );
    }
}
