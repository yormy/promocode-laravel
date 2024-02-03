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
        $storing = $data->toArray();
        unset($storing['xid']);

        return $this->model->create($storing);
    }

    public function update(InviteCodeDataRequest $data): PromocodeInvite
    {
        $storing = $data->toArray();
        unset($storing['xid']);

        $this->model->update($storing);

        return $this->model->refresh();
    }
}
