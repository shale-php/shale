<?php

describe('Pest Architecture Presets', function (): void {
    arch('PHP')
        ->preset()
        ->php();

    arch('Laravel')
        ->preset()
        ->laravel();

    arch('Security')
        ->preset()
        ->security();
});

arch()->expect('Bagwaa\ShaleAi')
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump']);
