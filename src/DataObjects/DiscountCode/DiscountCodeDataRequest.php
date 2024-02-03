<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\DataObjects\Promocode\PromocodeDataRequest;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class DiscountCodeDataRequest extends PromocodeDataRequest
{

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

        public ?int $description_discount_amount,
        public ?int $description_discount_percentage,
        public string $stripe_discount_coupon,
    ) {
        parent::__construct(
            internal_name: $internal_name,
            description: $description,
            code: $code,

            uses_max: $uses_max,
            active_from: $active_from,
            expires_at: $expires_at,

            for_user_id: $for_user_id,
            for_ip: $for_ip,
            for_email: $for_email,
        );
    }


}
