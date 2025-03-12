<?php

declare(strict_types=1);

namespace Shale\Shale\Facades;

use Illuminate\Support\Facades\Facade;

class ShaleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shale';
    }
}
