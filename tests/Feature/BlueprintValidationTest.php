<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('store blueprint with missing required fields returns 422', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->postJson('/api/blueprints', []);

    expect($response->status())->toBe(422);
    expect($response->json('errors'))->toHaveKey('name');
});
