<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class InviteCodeData extends Data
{
    //const MODEL = PromocodeInvite::class;

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

    public static function rules(): array
    {
        $rules['internal_name'] = ['required', 'string', 'max:100'];
        $rules['description'] = ['required', 'string', 'max:100'];
        $rules['code'] = ['unique:promocodes_invites,code', 'string', 'max:9'];

        $rules['uses_max'] = ['required', 'integer', 'min:0','max:10000'];
        $rules['active_from'] = ['required', 'date'];
        $rules['expires_at'] = ['required', 'date'];

        $rules['for_user_id'] = ['sometimes', 'nullable'];
        $rules['for_ip'] = ['sometimes', 'nullable', 'string', 'max:100'];
        $rules['for_email'] = ['sometimes', 'nullable', 'string', 'email'];

        return $rules;
    }

    public static function examples(): array
    {
        $example['internal_name'] = 'Christmas Bonus';
        $example['description'] = 'Special 2024 christmas bonus';
        $example['code'] = '1WQWERTR4';
        $example['uses_max'] = '10';
        $example['active_from'] = '20224-12-20 00:00:00';
        $example['expires_at'] = '20224-12-31 00:00:00';
        $example['for_ip'] = '198.12.13.100';
        $example['for_email'] = 'welcome@example.com';

        $example['xid'] = '123123!24';
        $example['uses_current'] = '2';
        $example['uses_left'] = '8';
        $example['is_active'] = true;
        $example['is_available'] = true;
        $example['deleted_at'] = null;

        return $example;
    }

    public static function descriptions(): array
    {
        $example['internal_name'] = 'Name just for internal use';

        return $example;
    }

    public function withExtended()
    {
        return $this
            ->include('xid')
            ->include('uses_current')
            ->include('deleted_at')

            ->include('uses_left')
            ->include('is_active')
            ->include('is_available');
    }

    public function asResource()
    {
        return $this->withExtended()->toArray();
    }

}
