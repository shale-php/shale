<?php

use Illuminate\Support\Facades\Route;
use Shale\Shale\AiModels\Claude;

Route::get('/', function () {
    $response = Shale::using(
        Claude::make()
    )->prompt('What is the capital of France?');

    echo $response;
});
