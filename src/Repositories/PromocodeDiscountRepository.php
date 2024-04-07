<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\DiscountCode\DiscountCodeDataRequest;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;

class PromocodeDiscountRepository
{
    public function __construct(private ?DiscountCodeStripe $model = null)
    {
        if (! $model) {
            $this->model = new DiscountCodeStripe();
        }
    }

    public function create(DiscountCodeDataRequest $data): DiscountCodeStripe
    {
        $storing = $data->toArray();
        unset($storing['xid']);

        return $this->model->create($storing);
    }

    public function update(DiscountCodeDataRequest $data): DiscountCodeStripe
    {
        $storing = $data->toArray();
        unset($storing['xid']);

        $this->model->update($storing);

        return $this->model->refresh();
    }
}
