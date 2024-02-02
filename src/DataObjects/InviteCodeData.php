<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Lazy;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class InviteCodeData extends InviteCodeDataBase
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

        public Lazy | string | null $xid,
        public Lazy | int $uses_current,
        public Lazy | int $uses_left,
        public Lazy | bool $is_active,
        public Lazy | bool $is_available,

        public Lazy | CarbonImmutable | null $deleted_at,
    ) {
        $this->code = $code ?? CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $this->active_from = $active_from ?? CarbonImmutable::now();
        $this->expires_at = $expires_at ?? CarbonImmutable::now()->addMonth(1);
        $this->uses_max = $uses_max ?? 10;
    }

    public static function fromModel($model): self
    {
        return new self(
            internal_name: $model->internal_name,
            description: $model->description,
            code: $model->code,

            uses_max: (int)$model->uses_max,
            active_from: CarbonImmutable::parse($model->active_from),
            expires_at: CarbonImmutable::parse($model->expires_at),

            for_user_id: (int)$model->for_user_id,
            for_ip: $model->for_ip,
            for_email: $model->for_email,

            xid: Lazy::create(fn() => $model->xid),
            uses_current: Lazy::create(fn() => (int)$model->uses_current),
            uses_left: Lazy::create(fn() => (int)$model->uses_left),
            is_active: Lazy::create(fn() => (bool)$model->is_active),
            is_available: Lazy::create(fn() => (bool)$model->is_available),

            deleted_at: Lazy::create(fn() => CarbonImmutable::parse($model->deleted_at)),
        );
    }
}
