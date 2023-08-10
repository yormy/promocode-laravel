<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Yormy\PromocodeLaravel\Models\PromocodeStripe;

return new class extends Migration
{
    public function up()
    {
        $model = config('promocode.models.stripe');

        Schema::create((new $model)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('internal_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('description_discount_percentage')->nullable();
            $table->integer('description_discount_amount_cents')->nullable();

            $table->string('code',20)->unique();

            $table->integer('max_uses')->default(1);
            $table->integer('current_uses')->default(0);

            // Limit who can use it
            $table->unsignedBigInteger('for_user_id')->nullable();
            $table->string('for_user_type')->nullable();
            $table->string('for_ip')->nullable();
            $table->string('for_email')->nullable();

            // only within period
            $table->datetime('active_from')->default(now());
            $table->datetime('expires_at')->nullable();

            // stripe specific
            $table->string('stripe_coupon_id');


            $table->timestamps();
        });
    }
};
