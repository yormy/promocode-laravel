<?php

namespace Yormy\PromocodeLaravel\Services;

use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;

abstract class PromocodeValidate
{
    public static function check(?string $code)
    {
        $promocode = self::getValid($code);

        if (! $promocode) {
            throw new InvalidCodeException();
        }

        return $promocode;
    }

    public static function getValid(?string $code)
    {
        if (! $code) {
            return null;
        }

        $promocode = static::builderActive($code)
            ->get()
            ->first();

        return $promocode;
    }

    public static function checkForUser(string $code, $user)
    {
        $promocode = static::builderActive($code)
            ->forUser($user)
            ->get()
            ->first();

        if (! $promocode) {
            throw new InvalidCodeException();
        }

        return $promocode;
    }

    public static function checkForEmail(string $code, string $email)
    {
        $promocode = static::builderActive($code)
            ->forEmail($email)
            ->get()
            ->first();

        if (! $promocode) {
            throw new InvalidCodeException();
        }

        return $promocode;
    }

    public static function checkForIp(string $code, string $ip)
    {
        $promocode = static::builderActive($code)
            ->forIp($ip)
            ->get()
            ->first();

        if (! $promocode) {
            throw new InvalidCodeException();
        }

        return $promocode;
    }

    private static function builderActive(string $code)
    {
        return static::getModel()
            ->active()
            ->available()
            ->where('code', $code);
    }
}
