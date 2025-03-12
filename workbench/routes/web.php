<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $response = Shale::prompt('What is the capital of France?');
    echo $response;
});
