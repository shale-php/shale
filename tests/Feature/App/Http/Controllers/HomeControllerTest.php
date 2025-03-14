<?php

declare(strict_types=1);

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Aws\Result;
use Shale\Shale\ShaleCore;

uses(Tests\TestCase::class);

beforeEach(function (): void {
    config(['app.key' => 'base64:Zx6J6xJwkhje7B8CnUJ7xGrq0Wl9UBhHG4GpYXuZJ3A=']);
});

it('should prompt and execute', function (): void {
    $client = Mockery::mock(BedrockRuntimeClient::class);

    $client->shouldReceive('invokeModel')->andReturn(new Result([
        'body' => json_encode([
            'content' => [
                [
                    'text' => 'Hello, world!',
                ],
            ],
        ]),
    ]));

    app()->instance('shale', new ShaleCore($client));

    $this->get('/')->assertSee('Hello, world!');
});
