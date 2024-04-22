<?php

namespace Yormy\PromocodeLaravel\Database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;

return new class extends Migration
{
    public function up()
    {
        $model = config('promocode.models.stripe_redeem');

        Schema::create((new $model)->getTable(), function (Blueprint $table) {
            self::create($table);
        });
    }

    public static function create(Blueprint $table): Blueprint
    {
        $table->id();
        $table->string('xid')->unique();

        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('user_type')->nullable();

        $table->foreignIdFor(DiscountCodeStripe::class, 'billing_promocode_stripe_id');

        $table->timestamps();

        return $table;
    }
};
