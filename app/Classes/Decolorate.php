<?php

namespace App\Classes;



use Illuminate\Http\UploadedFile;

class Decolorate
{
    /**
     * @var $FILE UploadedFile
     */
    private $FILE = null;

    /**
     * Constructor
     */
    public function __construct($file)
    {
        $this->FILE = $file;

    }

     function sayHi()
    {
        echo $this->FILE->getBasename();
    }


}
