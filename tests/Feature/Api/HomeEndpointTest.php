<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_requires_authentication()
    {
        $response = $this->getJson('/api/v1/home');
        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Unauthenticated.'
                 ]);
    }

    public function test_home_returns_expected_json_for_authenticated_user()
    {
        $user = \App\Models\User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->getJson('/api/v1/home');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user' => ['id', 'username', 'email'],
                     'daily_task_summary',
                     'recent_storybooks'
                 ]);
    }
}
