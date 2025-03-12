<?php

declare(strict_types=1);

namespace Shale\Shale\Providers;

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Illuminate\Support\ServiceProvider;
use Shale\Shale\ShaleCore;

class ShaleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('shale', function (): \Shale\Shale\ShaleCore {
            $config = [
                'region' => config('shale.aws_region'),
                'version' => 'latest',
                'credentials' => [
                    'key' => config('shale.aws_access_key'),
                    'secret' => config('shale.aws_secret_access_key'),
                ],
            ];

            $client = new BedrockRuntimeClient($config);

            return new ShaleCore($client, config('shale.aws_bedrock_model_id'));
        });

        $this->mergeConfigFrom(__DIR__ . '/../../config/shale.php', 'shale');
    }

    public function boot(): void
    {
        if (! file_exists(config_path('shale.php'))) {
            $this->publishes([
                __DIR__ . '/../../config/shale.php' => config_path('shale.php'),
            ], 'shale-config');
        }
    }
}
