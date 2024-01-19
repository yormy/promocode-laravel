<?php

namespace Yormy\PromocodeLaravel\Database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $model = config('promocode.models.invite');

        Schema::create((new $model)->getTable(), function (Blueprint $table) {
            self::create($table);
        });
    }

    public static function create(Blueprint $table): Blueprint
    {
        $table->id();
        $table->string('xid')->unique();
        $table->string('internal_name')->nullable();
        $table->string('description')->nullable();

        $table->string('code', 20)->unique();

        $table->integer('max_uses')->default(1);
        $table->integer('current_uses')->default(0);

        // Limit who can use it
        $table->unsignedBigInteger('for_user_id')->nullable();
        $table->string('for_user_type')->nullable();
        $table->string('for_ip')->nullable();
        $table->string('for_email')->nullable();

        // only within period
        $table->datetime('active_from')->nullable();
        $table->datetime('expires_at')->nullable();

        $table->timestamps();
        $table->softDeletes();

        return $table;
    }
};
