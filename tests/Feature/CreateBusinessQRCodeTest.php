<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CreateBusinessQRCodeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_can_create_business_qrcode(): void
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
    }

    public function test_if_owner_name_is_required(): void
    {
        $faker = Faker::create('pt_PT');

        $requestParams = [
            'github_url' => $faker->url(),
            'linkedin_url' => $faker->url(),
        ];

        $response = $this->json('POST', '/api/business-qrcode', $requestParams);

        // Assert HTTP Status is "422 Unprocessable Entity"
        $response->assertStatus(422);
    }

    public function test_if_linkedin_url_is_required(): void
    {
        $faker = Faker::create('pt_PT');

        $requestParams = [
            'owner_name' => $faker->name(),
            'github_url' => $faker->url(),
        ];

        $response = $this->json('POST', '/api/business-qrcode', $requestParams);

        // Assert HTTP Status is "422 Unprocessable Entity"
        $response->assertStatus(422);
    }

    public function test_if_github_url_is_required(): void
    {
        $faker = Faker::create('pt_PT');

        $requestParams = [
            'owner_name' => $faker->name(),
            'linkedin_url' => $faker->url(),
        ];

        $response = $this->json('POST', '/api/business-qrcode', $requestParams);

        // Assert HTTP Status is "422 Unprocessable Entity"
        $response->assertStatus(422);
    }

    public function test_if_github_url_must_be_url(): void
    {
        $faker = Faker::create('pt_PT');

        $requestParams = [
            'owner_name' => $faker->name(),
            'github_url' => Str::random(10),
            'linkedin_url' => $faker->url(),
        ];

        $response = $this->json('POST', '/api/business-qrcode', $requestParams);

        // Assert HTTP Status is "422 Unprocessable Entity"
        $response->assertStatus(422);
    }

    public function test_if_linkedin_url_must_be_url(): void
    {
        $faker = Faker::create('pt_PT');

        $requestParams = [
            'owner_name' => $faker->name(),
            'github_url' => $faker->url(),
            'linkedin_url' => Str::random(10),
        ];

        $response = $this->json('POST', '/api/business-qrcode', $requestParams);

        // Assert HTTP Status is "422 Unprocessable Entity"
        $response->assertStatus(422);
    }
}
