<?php

namespace App\Classes;


use App\Helpers\MathHelper;

class Decolorate
{

    private $path;
    private $image;
    const COLORS = [
        "AQUA" => "#00ffff",
        "BLACK" => "#000000",
        "BLUE" => "#0000ff",
        "FUCHSIA" => "#ff00ff",
        "GRAY" => "#808080",
        "GREEN" => "#008000",
        "LIME" => "#00ff00",
        "MAROON" => "#800000",
        "NAVY" => "#000080",
        "OLIVE" => "#808000",
        "PURPLE" => "#800080",
        "RED" => "#ff0000",
        "SILVER" => "#c0c0c0",
        "TEAL" => "#008080",
        "WHITE" => "#ffffff",
        "YELLOW" => "#ffff00"
    ];

    /**
     * Constructor
     */
    public function __construct($path)
    {   //IMPORTANT
        //This is not recommended for a production environment, but this code will never go to production.
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        //END IMPORTANT

        $this->path = $path;
        $size = getimagesize($this->path);
        if ($size[2] == 1) {
            $this->image = imagecreatefromgif($this->path);
        }
        if ($size[2] == 2) {
            $this->image = imagecreatefromjpeg($this->path);
        }
        if ($size[2] == 3) {
            $this->image = imagecreatefrompng($this->path);
        }
        if (is_null($this->image)) {
            die("Try to upload a image type .png .jpeg .gif");
        }
    }

    /**
     * @return \stdClass
     */
    function getColor()
    {

        $imgWidth = imagesx($this->image);
        $imgHeight = imagesy($this->image);
        $hexArray = $this::COLORS;
        for ($y = 0; $y < $imgHeight; $y++) {
            for ($x = 0; $x < $imgWidth; $x++) {
                $index = imagecolorat($this->image, $x, $y);
                $colors = imagecolorsforindex($this->image, $index);
                $hexArray[]=$this::getColorLowerDistance($colors);
            }
        }

        $hexArray = array_count_values($hexArray);
        natsort($hexArray);
        $hexArray = array_reverse($hexArray, true);
        $toReturn = new \stdClass();
        $toReturn->hexarray = $hexArray;
        $toReturn->imagePath = $this->path;
        $toReturn->COLORS = $this::COLORS;

        $color = array_keys($hexArray);
        if (intval($hexArray[$color[0]] - 1) <= 0) {
            $toReturn->error = 'Any color predominates in the list';
        }
        return $toReturn;

    }

    function getColorLowerDistance($colorToCompare)
    {
        $lowerDistance = null;
        $tmpColor = null;
        foreach ($this::COLORS as $key => $color) {
            $colorBase = $this::hex2rgb($color);
            $distance = MathHelper::getDistance3D(array($colorToCompare['red'], $colorToCompare['green'], $colorToCompare['blue']), $colorBase);
            if (!isset($lowerDistance)) {
                $lowerDistance = $distance;
                $tmpColor = $color;
            } else if ($distance < $lowerDistance) {
                $lowerDistance = $distance;
                $tmpColor = $color;
            } else if ($distance == $lowerDistance) {
                $toReturn = $color;
            }
        }
        $toReturn = $tmpColor;
        return $toReturn;
    }


    function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);

        return $rgb;
    }
}
