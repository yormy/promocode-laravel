<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\Promocode;

use Carbon\CarbonImmutable;

abstract class PromocodeDataResponse extends PromocodeData
{
    public function __construct(
        public string $xid,
        public string $internal_name,
        public string $description,
        public ?string $code,

        public ?int $uses_max,
        public ?CarbonImmutable $active_from,
        public ?CarbonImmutable $expires_at,

        public string|int|null $for_user_id,
        public ?string $for_ip,
        public ?string $for_email,

        public int $uses_current,
        public int $uses_left,
        public bool $is_active,
        public bool $is_available,

        public ?CarbonImmutable $deleted_at,
    ) {
    }

    protected static function constructorData($model): array
    {
        return [
            $model->xid,

            $model->internal_name,
            $model->description,
            $model->code,

            (int) $model->uses_max,
            CarbonImmutable::parse($model->active_from),
            CarbonImmutable::parse($model->expires_at),

            $model->for_user_id,
            $model->for_ip,
            $model->for_email,

            (int) $model->uses_current,
            (int) $model->uses_left,
            (bool) $model->is_active,
            (bool) $model->is_available,

            CarbonImmutable::parse($model->deleted_at),
        ];
    }

    public static function fromModel($model): self
    {
        $constuctorData = self::constructorData($model);

        return new static(...$constuctorData);
    }
}
