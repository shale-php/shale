<?php

declare(strict_types=1);

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Aws\Result;
use Shale\Shale\AiModels\AI21LabsJamba15Mini;
use Shale\Shale\AiModels\Claude3;
use Shale\Shale\ShaleCore;

it('can prompt the model and get a response from the Claude3 model', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')->andReturn(new Result([
        'body' => json_encode([
            'content' => [
                [
                    'text' => 'The capital of France is Paris.',
                ],
            ],
        ]),
    ]));

    $core = new ShaleCore($client);

    $response = $core
        ->using(
            Claude3::make()
        )
        ->prompt('What is the capital of France?')
        ->execute();

    expect($response)->toBe('The capital of France is Paris.');
});

it('can handle an error when invoking the Claude3 model', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')
        ->andThrow(new Exception('Model not found'));

    $core = new ShaleCore($client);

    $response = $core
        ->using(
            Claude3::make()
        )
        ->prompt('What is the capital of France?')
        ->execute();

    expect($response)->toBe('Error: Model not found');
});

it('can prompt the model and get a response from the AI21LabsJamba15Mini model', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')->andReturn(new Result([
        'body' => json_encode([
            'choices' => [
                [
                    'message' => [
                        'content' => 'The capital of France is Paris.',
                    ],
                ],
            ],
        ]),
    ]));

    $core = new ShaleCore($client);

    $response = $core
        ->using(
            AI21LabsJamba15Mini::make()
        )
        ->prompt('What is the capital of France?')
        ->execute();

    expect($response)->toBe('The capital of France is Paris.');
});

it('can handle an error when invoking the AI21LabsJamba15Mini model', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')
        ->andThrow(new Exception('Model not found'));

    $core = new ShaleCore($client);

    $response = $core
        ->using(
            AI21LabsJamba15Mini::make()
        )
        ->prompt('What is the capital of France?')
        ->execute();

    expect($response)->toBe('Error: Model not found');
});
