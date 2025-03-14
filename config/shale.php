<?php

declare(strict_types=1);

return [
    'aws_region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'aws_access_key' => env('AWS_ACCESS_KEY_ID'),
    'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
];
