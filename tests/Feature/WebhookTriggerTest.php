<?php

use App\Jobs\ExecuteWorkflow;
use App\Models\Workflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

beforeEach(function () {
    Queue::fake();
});

it('triggers workflow with valid webhook token', function () {
    $workflow = Workflow::factory()->withWebhook('test-token-12345678901234567890123456789012')->create();

    $response = $this->postJson('/api/webhooks/test-token-12345678901234567890123456789012', [
        'event' => 'test.event',
        'data' => ['foo' => 'bar'],
    ]);

    $response->assertStatus(202)
        ->assertJson([
            'success' => true,
            'message' => 'Workflow triggered successfully',
            'workflow_id' => $workflow->id,
        ]);

    Queue::assertPushed(ExecuteWorkflow::class, function ($job) use ($workflow) {
        return $job->workflow->id === $workflow->id
            && $job->webhookPayload['event'] === 'test.event'
            && $job->webhookPayload['data']['foo'] === 'bar';
    });
});

it('returns 404 for invalid webhook token', function () {
    $response = $this->postJson('/api/webhooks/invalid-token', [
        'event' => 'test.event',
    ]);

    $response->assertNotFound()
        ->assertJson([
            'success' => false,
            'error' => 'Webhook not found or not active',
        ]);

    Queue::assertNothingPushed();
});

it('returns 404 when webhook is disabled', function () {
    $workflow = Workflow::factory()->create([
        'webhook_enabled' => false,
        'webhook_token' => 'disabled-token-1234567890123456789012345678',
    ]);

    $response = $this->postJson('/api/webhooks/disabled-token-1234567890123456789012345678', [
        'event' => 'test.event',
    ]);

    $response->assertNotFound();
    Queue::assertNothingPushed();
});

it('returns 404 when workflow is inactive', function () {
    $workflow = Workflow::factory()->inactive()->withWebhook('inactive-token-123456789012345678901234567')->create();

    $response = $this->postJson('/api/webhooks/inactive-token-123456789012345678901234567', [
        'event' => 'test.event',
    ]);

    $response->assertNotFound();
    Queue::assertNothingPushed();
});

it('generates webhook token for workflow', function () {
    $workflow = Workflow::factory()->create();

    expect($workflow->webhook_token)->toBeNull();

    $workflow->generateWebhookToken();
    $workflow->refresh();

    expect($workflow->webhook_token)->toBeString()
        ->and(strlen($workflow->webhook_token))->toBe(40);
});

it('returns correct webhook url attribute', function () {
    $workflow = Workflow::factory()->withWebhook('my-webhook-token-12345678901234567890123456')->create();

    expect($workflow->webhook_url)->toContain('/api/webhooks/my-webhook-token-12345678901234567890123456');
});

it('returns null webhook url when token is not set', function () {
    $workflow = Workflow::factory()->create();

    expect($workflow->webhook_url)->toBeNull();
});
