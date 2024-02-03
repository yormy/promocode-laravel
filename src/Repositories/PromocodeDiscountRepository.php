<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\DiscountCode\DiscountCodeDataRequest;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;

class PromocodeDiscountRepository
{
    public function __construct(private ?DiscountCodeStripe $model = null)
    {
        if (!$model) {
            $this->model = new DiscountCodeStripe();
        }
    }

    public function create(DiscountCodeDataRequest $data): DiscountCodeStripe
    {
        return $this->model->create($data->toArray());
    }

    public function update(DiscountCodeDataRequest $data): DiscountCodeStripe
    {
        $this->model->update($data->toArray());

        return $this->model->refresh();
    }
}
