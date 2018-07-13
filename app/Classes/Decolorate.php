<?php

namespace App\Classes;


class Decolorate
{

    private $image = null;
    const COLORS = [
        "00ffff",
        "000000",
        "0000ff",
        "ff00ff",
        "808080",
        "008000",
        "00ff00",
        "800000",
        "000080",
        "808000",
        "800080",
        "ff0000",
        "c0c0c0",
        "008080",
        "ffffff",
        "ffff00"];

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
            $hexArray = $this::COLORS;
            for ($y = 0; $y < $imgHeight; $y++) {
                for ($x = 0; $x < $imgWidth; $x++) {
                    $index = imagecolorat($image, $x, $y);
                    $Colors = imagecolorsforindex($image, $index);
                   $pixelColor=  sprintf('%02x%02x%02x',$Colors['red'], $Colors['green'], $Colors['blue']);
//                    if (in_array($pixelColor,  $this::COLORS)) {
//                        $hexArray[] = $pixelColor;
//                    }
                    if ($pixelColor==$this::COLORS[0] or
                        $pixelColor==$this::COLORS[1] or
                        $pixelColor==$this::COLORS[2] or
                        $pixelColor==$this::COLORS[3] or
                        $pixelColor==$this::COLORS[4] or
                        $pixelColor==$this::COLORS[5] or
                        $pixelColor==$this::COLORS[6] or
                        $pixelColor==$this::COLORS[7] or
                        $pixelColor==$this::COLORS[8] or
                        $pixelColor==$this::COLORS[9] or
                        $pixelColor==$this::COLORS[10] or
                        $pixelColor==$this::COLORS[11] or
                        $pixelColor==$this::COLORS[12] or
                        $pixelColor==$this::COLORS[13] or
                        $pixelColor==$this::COLORS[14] or
                        $pixelColor==$this::COLORS[15]
                    ){
                        $hexArray[] = $pixelColor;
                    }


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
