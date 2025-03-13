<?php

declare(strict_types=1);

namespace Workbench\App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Orchestra\Workbench\Http\Controllers\Controller;
use Shale\Shale\AiModels\Claude3;
use Shale\Shale\Facades\ShaleFacade as Shale;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $response = Shale::using(Claude3::make())
            ->prompt('What is the capital of France?')
            ->execute();

        return response()->json($response, Response::HTTP_OK);
    }
}
