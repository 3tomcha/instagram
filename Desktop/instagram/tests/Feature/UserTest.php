<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('ajax/favorites/2');
        var_dump($response->responseText);
        $this->assertTrue(true);
        // var_dump($response);

        // $this->assertSame("aaa",$response);
    }
}
