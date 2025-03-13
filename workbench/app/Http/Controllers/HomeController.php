<?php

declare(strict_types=1);

namespace Workbench\App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Orchestra\Workbench\Http\Controllers\Controller;
use Shale\Shale\AiModels\AI21LabsJamba15Mini;
use Shale\Shale\AiModels\Claude3;
use Shale\Shale\Facades\ShaleFacade as Shale;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $question = 'What is the capital of France?';

        $claudeReply = Shale::using(Claude3::make())
            ->prompt($question)
            ->execute();

        $ai21LabsJurassic2Reply = Shale::using(AI21LabsJamba15Mini::make())
            ->prompt($question)
            ->execute();

        return response()->json([
            'Claude3' => $claudeReply,
            'AI21LabsJurassic2' => $ai21LabsJurassic2Reply,
        ], Response::HTTP_OK);
    }
}
