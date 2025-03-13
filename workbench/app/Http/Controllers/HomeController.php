<?php

declare(strict_types=1);

namespace Workbench\App\Http\Controllers;

use Illuminate\Http\Request;
use Orchestra\Workbench\Http\Controllers\Controller;
use Shale\Shale\AiModels\Claude;
use Shale\Shale\Facades\ShaleFacade as Shale;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $response = Shale::using(
            Claude::make()
        )->prompt('What is the capital of France?');

        return $response;
    }
}
