<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\DataObjects\Promocode\PromocodeDataRequest;

class DiscountCodeDataRequest extends PromocodeDataRequest
{
    use DiscountCodeTrait;

    public function __construct(
        public string $internal_name,
        public string $description,
        public ?string $code,

        public ?int $uses_max,
        public ?CarbonImmutable $active_from,
        public ?CarbonImmutable $expires_at,

        public string | int | null $for_user_id,
        public ?string $for_ip,
        public ?string $for_email,

        public ?int $description_discount_amount_cents,
        public ?int $description_discount_percentage,
        public string $stripe_coupon_id,
    ) {
    }


}
