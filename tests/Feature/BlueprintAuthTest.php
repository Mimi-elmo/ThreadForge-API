<?php

use App\Models\Blueprint;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('unauthenticated request to blueprints returns 401', function () {
    $response = $this->getJson('/api/blueprints');

    expect($response->status())->toBe(401);
});

test('authenticated request to blueprints returns 200 with correct structure', function () {
    $user = User::factory()->create();

    Blueprint::factory()->for($user)->create([
        'name'            => 'Tech Twitter',
        'target_audience' => 'Developers',
        'tone'            => 'Professional',
    ]);

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/blueprints');

    expect($response->status())->toBe(200);
    expect($response->json('data'))->toBeArray()->toHaveCount(1);
    expect($response->json('data.0'))->toHaveKeys([
        'id', 'name', 'target_audience', 'tone',
        'max_characters', 'max_hashtags', 'rules', 'created_at',
    ]);
});
