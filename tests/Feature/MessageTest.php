<?php

use App\Models\Message;
use App\Models\User;

it('can index all messages', function () {
    Message::factory(3)->create();

    $response = $this->getJson('/api/messages');

    $response->assertSuccessful()
        ->assertJsonCount(3, 'data');
});

it('can store a new message', function () {
    $user = User::factory()->create();
    $data = [
        'user_id' => $user->id,
        'content' => 'This is a test message',
    ];

    $response = $this->postJson('/api/messages', $data);

    $response->assertSuccessful()
        ->assertJsonFragment(['content' => 'This is a test message']);

    $this->assertDatabaseHas('messages', $data);
});

it('validates required fields when storing', function () {
    $response = $this->postJson('/api/messages', []);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['user_id', 'content']);
});

it('can show a specific message', function () {
    $message = Message::factory()->create();

    $response = $this->getJson("/api/messages/{$message->id}");

    $response->assertSuccessful()
        ->assertJsonFragment(['content' => $message->content]);
});

it('can update a message', function () {
    $message = Message::factory()->create();
    $updateData = ['content' => 'Updated content'];

    $response = $this->putJson("/api/messages/{$message->id}", $updateData);

    $response->assertSuccessful()
        ->assertJsonFragment(['content' => 'Updated content']);

    $this->assertDatabaseHas('messages', $updateData);
});

it('can delete a message', function () {
    $message = Message::factory()->create();

    $response = $this->deleteJson("/api/messages/{$message->id}");

    $response->assertSuccessful();
    $this->assertModelMissing($message);
});

it('returns 404 for non-existent message', function () {
    $response = $this->getJson('/api/messages/999');

    $response->assertNotFound();
});
