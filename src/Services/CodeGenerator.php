<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Services;

class CodeGenerator
{
    public const TYPE_NUMERIC = 1;

    public const TYPE_NUMERIC_ALPHA_UPPERCASE = 2;

    public const TYPE_NUMERIC_ALPHA_LOWERCASE = 3;

    public const TYPE_NUMERIC_ALPHA_UPPERLOWERCASE = 4;

    public static function generate(int $type = self::TYPE_NUMERIC_ALPHA_UPPERCASE, int $length = 6): string
    {
        switch ($type) {
            case static::TYPE_NUMERIC:
                $characters = '0123456789';
                break;
            case static::TYPE_NUMERIC_ALPHA_UPPERCASE:
                $characters = '23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // remove 0 and 1
                break;
            case static::TYPE_NUMERIC_ALPHA_LOWERCASE:
                $characters = '23456789abcdefghijklmnopqrstuvwxyz'; // remove 0 and 1
                break;
            case static::TYPE_NUMERIC_ALPHA_UPPERLOWERCASE:
                $characters = '23456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // remove 0 and 1
                break;
            default:
                $characters = '23456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // remove 0 and 1
                break;
        }

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
