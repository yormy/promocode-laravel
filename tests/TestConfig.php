<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Tests;

class TestConfig
{
    public static function setup(): void
    {
        config(['promocode' => require __DIR__.'/../config/promocode.php']);
        config(['app.key' => 'base64:yNmpwO5YE6xwBz0enheYLBDslnbslodDqK1u+oE5CEE=']);
    }
}
