<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\locations;

class LocationsTest extends TestCase
{
        /** @test */
    public function it_can_create_a_location()
    {
        $name = "test";
        $roomnumber = "test";
        $description = "test";

        $data = [
            'name' => $name,
            'roomnumber' => $roomnumber,
            'description' => $description
        ];

        $this->post("api/locations", $data)
        ->assertStatus(201)
        ->assertJsonStructure(array_keys($data), $data);
    }

}
