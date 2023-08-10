<?php

namespace Yormy\PromocodeLaravel\Tests\Traits;

use Yormy\PromocodeLaravel\Tests\Setup\Models\User;

trait UserTrait
{
    private function createUser()
    {
        $user = User::create([
            'email' => 'test@exampel.com',
        ]);

        return $user;
    }
}
