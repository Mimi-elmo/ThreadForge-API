<?php

use App\Jobs\GeneratePostJob;
use App\Models\Blueprint;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\Sanctum;

test('content repurpose dispatches job and returns 202', function () {
    Queue::fake();

    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $blueprint = Blueprint::factory()->for($user)->create([
        'name'            => 'Tech Twitter',
        'target_audience' => 'Developers',
        'tone'            => 'Professional',
    ]);

    $response = $this->postJson('/api/content/repurpose', [
        'blueprint_id' => $blueprint->id,
        'content'      => 'Laravel 11 introduces many new features for developers.',
    ]);

    expect($response->status())->toBe(202);
    expect($response->json())->toHaveKeys(['message', 'data']);

    Queue::assertPushed(GeneratePostJob::class);
});
