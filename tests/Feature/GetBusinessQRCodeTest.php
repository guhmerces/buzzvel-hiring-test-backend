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
        $response = $this->json('GET', "/api/{$owner_name}", $requestParams);
        
        //Assert HTTP Status is "200 OK"
        $response->assertStatus(200);
        
        // Assertions about the returned json
        $responseData = $response->decodeResponseJson();
        assert($responseData['owner_name'], $requestParams['owner_name']);
        assert($responseData['github_url'], $requestParams['github_url']);
        assert($responseData['linkedin_url'], $requestParams['linkedin_url']);
        assertNotNull($responseData['qrcode_path']);
        assertNotNull($responseData['qrcode_url']);
    }
}
