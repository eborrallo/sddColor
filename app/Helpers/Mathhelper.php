<?php
/**
 * Created by PhpStorm.
 * User: Enric
 * Date: 16/07/2018
 * Time: 17:25
 */

namespace App\Helpers;


class MathHelper
{

   public static function getDistance3D($p1, $p2)
    {
        return sqrt(pow($p2[0] - $p1[0], 2) + pow($p2[1] - $p1[1], 2) + pow($p2[2] - $p1[2], 2));
    }
}