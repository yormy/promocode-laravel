<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\Promocode;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

abstract class PromocodeDataRequest extends PromocodeData
{
    public function __construct(
        public ?string $xid,
        public string $internal_name,
        public string $description,
        public ?string $code,

        public ?int $uses_max,
        public ?CarbonImmutable $active_from,
        public ?CarbonImmutable $expires_at,

        public string | int | null $for_user_id,
        public ?string $for_ip,
        public ?string $for_email,
    ) {
        $this->code = $code ?? CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $this->active_from = $active_from ?? CarbonImmutable::now();
        $this->expires_at = $expires_at ?? CarbonImmutable::now()->addMonth(1);
        $this->uses_max = $uses_max ?? 10;
    }
}
