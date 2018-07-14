<?php

namespace App\Classes;


class Decolorate
{

    private $path;
    private $image;
    const COLORS = [
        "#00ffff",
        "#000000",
        "#0000ff",
        "#ff00ff",
        "#808080",
        "#008000",
        "#00ff00",
        "#800000",
        "#000080",
        "#808000",
        "#800080",
        "#ff0000",
        "#c0c0c0",
        "#008080",
        "#ffffff",
        "#ffff00"];

    /**
     * Constructor
     */
    public function __construct($path)
    {   //IMPORTANT
        //This is not recommended for a production environment, but this code will never go to production.
        ini_set('memory_limit', '-1');
        set_time_limit(120);
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
                $Colors = imagecolorsforindex($this->image, $index);
                $pixelColor = sprintf("#%02x%02x%02x", $Colors['red'], $Colors['green'], $Colors['blue']);
                if (in_array($pixelColor, $this::COLORS)) {
                    $hexArray[] = $pixelColor;
                }
            }
            //$hexArray= array_intersect($hexArray, $this::COLORS);
        }

        $hexArray = array_count_values($hexArray);
        natsort($hexArray);
        $hexArray = array_reverse($hexArray, true);
        $toResturn = new \stdClass();
        $toResturn->hexarray = $hexArray;
        $toResturn->imagePath = $this->path;

        $color = array_keys($hexArray);
        if ( intval($hexArray[$color[0]] - 1)<=0){
            $toResturn->error='Any color predominates in the list';
        }
        return $toResturn;

    }


}
