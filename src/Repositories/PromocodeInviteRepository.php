<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\InviteCode\InviteCodeDataRequest;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;

class PromocodeInviteRepository
{
    public function __construct(private ?PromocodeInvite $model = null)
    {
        if (!$model) {
            $this->model = new PromocodeInvite();
        }
    }

    public function create(InviteCodeDataRequest $data): PromocodeInvite
    {
        return $this->model->create($data->toArray());
    }

    public function update(InviteCodeDataRequest $data): PromocodeInvite
    {
        $this->model->update($data->toArray());

        return $this->model->refresh();
    }
}
