<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Shale\Shale\Facades\ShaleFacade as Shale;
use Shale\Shale\Providers\ShaleServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use WithWorkbench;

    protected function getPackageProviders($app): array
    {
        return [
            ShaleServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Shale' => Shale::class,
        ];
    }
}
