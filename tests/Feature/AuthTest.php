<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('login with valid credentials returns token', function () {
    User::factory()->create([
        'email'    => 'jane@example.com',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email'    => 'jane@example.com',
        'password' => 'secret123',
    ]);

    expect($response->status())->toBe(200);
    expect($response->json())->toHaveKeys(['token', 'user', 'message']);
});

test('login with invalid password returns 401', function () {
    User::factory()->create([
        'email'    => 'jane@example.com',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email'    => 'jane@example.com',
        'password' => 'wrong-password',
    ]);

    expect($response->status())->toBe(401);
    expect($response->json('message'))->toBe('Invalid credentials');
});
