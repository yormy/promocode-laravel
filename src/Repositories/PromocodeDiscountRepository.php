<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\DiscountCode\DiscountCodeDataRequest;
use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;

class PromocodeDiscountRepository
{
    public function __construct(private ?BillingPromocodeStripe $model = null)
    {
        if (!$model) {
            $this->model = new BillingPromocodeStripe();
        }
    }

    public function create(DiscountCodeDataRequest $data): BillingPromocodeStripe
    {
        return $this->model->create($data->toArray());
    }

    public function update(DiscountCodeDataRequest $data): BillingPromocodeStripe
    {
        $this->model->update($data->toArray());

        return $this->model->refresh();
    }
}
