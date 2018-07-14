<?php

namespace Tests\Unit;

use App\Classes\Decolorate;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ColorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    public function testDecolorate(){

        $imagePNG = UploadedFile::fake()->image('fake.png');
        $Decolorate = new Decolorate($imagePNG->getPathname());
        $response =$Decolorate->getColor();
        $this->assertObjectHasAttribute('hexarray',$response  );
        $this->assertObjectHasAttribute('imagePath',$response  );


    }

}
