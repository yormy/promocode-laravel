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
        $new =  $this->model->create($data->toArray());
        $new->refresh(); // todo Why? if I do not do this I do not get xid back in my instance

        return $new;
    }

}
