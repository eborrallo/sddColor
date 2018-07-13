<?php

namespace App\Classes;


class Decolorate
{

    private $image = null;
    const AQUA = "00FFF";
    const BLACK = "000000";
    const BLUE = "0000FF";
    const FUCHSIA = "FF00FF";
    const GRAY = "808080";
    const GREEN = "008000";
    const LIME = "00FF00";
    const MAROON = "800000";
    const NAVY = "000080";
    const OLIVE = "808000";
    const PURPLE = "800080";
    const RED = "FF0000";
    const SILVER = "C0C0C0";
    const TEAL = "008080";
    const WHITE = "FFFFFF";
    const YELLOW = "FFFF00";
    
    /**
     * Constructor
     */
    public function __construct($path)
    {
        ini_set('memory_limit', '-1');
        $this->image = $path;

    }

    function getColor()
    {
        if (isset($this->image)) {
            $image = null;
            $size = getimagesize($this->image);
            if ($size[2] == 1) {
                $image = imagecreatefromgif($this->image);
            }
            if ($size[2] == 2) {
                $image = imagecreatefromjpeg($this->image);
            }
            if ($size[2] == 3) {
                $image = imagecreatefrompng($this->image);
            }
            if (is_null($image)) {
                die("You image es null!");
            }

            $imgWidth = imagesx($image);
            $imgHeight = imagesy($image);
            $hexArray = null;
            for ($y = 0; $y < $imgHeight; $y++) {
                for ($x = 0; $x < $imgWidth; $x++) {
                    $index = imagecolorat($image, $x, $y);
                    $Colors = imagecolorsforindex($image, $index);
                    $hexArray[] = substr("0" . dechex($Colors['red']), -2) . substr("0" . dechex($Colors['green']), -2) . substr("0" . dechex($Colors['blue']), -2);
                }
            }
            $hexArray = array_count_values($hexArray);
            natsort($hexArray);
            $hexArray = array_reverse($hexArray, true);
            $toResturn = new \stdClass();
            $toResturn->hexarray = $hexArray;
            $toResturn->imagePath = $this->image;
            return $toResturn;

        } else die("You must enter a filename! (\$image parameter)");
    }


}
