<?php

declare(strict_types=1);

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Shale\Shale\ShaleCore;

it('can prompt the model and get a response', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')->andReturn([
        'body' => json_encode([
            'content' => [
                [
                    'text' => 'The capital of France is Paris.',
                ],
            ],
        ]),
    ]);

    $core = new ShaleCore($client, 'model-id');

    $response = $core->prompt('What is the capital of France?');

    expect($response)->toBe('The capital of France is Paris.');
});

it('can handle an error when invoking the model', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')
        ->andThrow(new Exception('Model not found'));

    $core = new ShaleCore($client, 'model-id');

    $response = $core->prompt('What is the capital of France?');

    expect($response)->toBe('Error: Model not found');
});
