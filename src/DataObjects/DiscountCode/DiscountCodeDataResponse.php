<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\DataObjects\Promocode\PromocodeDataResponse;

class DiscountCodeDataResponse extends PromocodeDataResponse
{
    use UseDiscountCodeExtension;

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
        return new static(
            xid: $model->xid,

            internal_name: $model->internal_name,
            description: $model->description,
            code: $model->code,

            uses_max: (int)$model->uses_max,
            active_from: CarbonImmutable::parse($model->active_from),
            expires_at: CarbonImmutable::parse($model->expires_at),

            for_user_id: (int)$model->for_user_id,
            for_ip: $model->for_ip,
            for_email: $model->for_email,

            uses_current: (int)$model->uses_current,
            uses_left: (int)$model->uses_left,
            is_active: (bool)$model->is_active,
            is_available: (bool)$model->is_available,

            deleted_at: CarbonImmutable::parse($model->deleted_at),

            description_discount_amount_cents: $model->description_discount_amount_cents,
            description_discount_percentage: $model->description_discount_percentage,
            stripe_coupon_id: $model->stripe_coupon_id,
        );
    }
}
