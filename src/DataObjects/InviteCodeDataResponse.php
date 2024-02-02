<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects;

use Carbon\CarbonImmutable;

class InviteCodeDataResponse extends InviteCodeDataBase
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

        public ?string $xid,
        public int $uses_current,
        public int $uses_left,
        public bool $is_active,
        public bool $is_available,

        public CarbonImmutable | null $deleted_at,
    ) {
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

            xid: $model->xid,
            uses_current: (int)$model->uses_current,
            uses_left: (int)$model->uses_left,
            is_active: (bool)$model->is_active,
            is_available: (bool)$model->is_available,

            deleted_at: CarbonImmutable::parse($model->deleted_at),
        );
    }
}
