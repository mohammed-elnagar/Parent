<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function get_all_providers_from_file()
    {
        $response = $this->get('api/v1/users');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function get_specefic_provider_file_exists()
    {
        $response = $this->get('api/v1/users?provider=DataProviderX');
        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function get_specefic_provider_file_but_not_exists()
    {
        $response = $this->get('api/v1/users?provider=DataProviderM');
        $response->assertStatus(404);
    }

}
