<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\InviteCodeData;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;

class PromocodeInviteRepository
{
    public function __construct(private ?PromocodeInvite $model = null)
    {
        if (!$model) {
            $this->model = new PromocodeInvite();
        }
    }

    public function create(InviteCodeData $data): PromocodeInvite
    {
        return $this->model->create($data->toArray());
    }

}
