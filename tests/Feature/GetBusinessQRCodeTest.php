<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertNotNull;

class GetBusinessQRCodeTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_if_can_access_a_newly_created_qrcode(): void
    {
        $faker = Faker::create('pt_PT');

        $requestParams = [
            'owner_name' => $faker->name(),
            'github_url' => $faker->url(),
            'linkedin_url' => $faker->url(),
        ];

        $response = $this->json('POST', '/api/business-qrcode', $requestParams);

        // Assert HTTP Status is "201 Created"
        $response->assertStatus(201);

        // Get the entity that were just created, by business owner name
        $owner_name = $requestParams['owner_name'];
        $response = $this->json('GET', "/api/{$owner_name}");
        
        //Assert HTTP Status is "200 OK"
        $response->assertStatus(200);
        
        // Assertions about the returned json
        $responseData = $response->decodeResponseJson();
        assertEquals($responseData['owner_name'], $requestParams['owner_name']);
        assertEquals($responseData['github_url'], $requestParams['github_url']);
        assertEquals($responseData['linkedin_url'], $requestParams['linkedin_url']);
        assertNotNull($responseData['qrcode_path']);
        assertNotNull($responseData['qrcode_url']);
    }

    public function test_if_accessing_a_unregistered_name_returns_http_404_not_found()
    {
        // Simulates a unregistered owner name
        $owner_name = Str::random(10);

        // Get
        $response = $this->json('GET', "/api/{$owner_name}");
        
        //Assert HTTP Status is "404 Not Found"
        $response->assertStatus(404);
    }
}
