<?php

namespace App;


class Color
{
    private const COLORS = [
        "red"    => "#FF0000",
        "green"  => "#00FF00",
        "blue"   => "#0000FF",
        "yellow" => "#F0FF12",
        "pink"   => "#FFC0CB",
        "black"  => "#000000"
    ];

    public static function getColorCode(string $string) : string
    {
        return isset(self::COLORS[$string]) ? self::COLORS[$string] : null;
    }
}