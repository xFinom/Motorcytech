<?php

namespace App\Traits;

trait EnumToArray
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function randomCase()
    {
        $cases = self::cases();
        return $cases[array_rand($cases)];
    }
}
