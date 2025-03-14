# Shale

Shale is a package to interact with AWS Bedrock, a service that provides a way to interact with LLMs (Large Language Models) in a secure and scalable way within the AWS infrastructure. You can learn more about Amazon Bedrock [here](https://aws.amazon.com/bedrock/).

## Installation 

You can install the package via composer:

```bash
composer require shale-php/shale
```

Next, publish the configuration file:

```bash
php artisan vendor:publish --tag=shale-config
```

This will auto discover the package and you can start using it straight away.

## Usage

First make sure you have the following environment variables set in your Laravel application:

```bash
AWS_DEFAULT_REGION=
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
```

Next make sure you have requested access to the bedrock models you want to use in your region within your AWS console.

You can then use the following code to interact with the bedrock model:

```php
$question = 'What is the capital of France?';

$claudeReply = Shale::using(Claude3::make())
    ->prompt($question)
    ->execute();

$AI21LabsReply = Shale::using(AI21LabsJamba15Mini::make())
    ->prompt($question)
    ->execute();

// The capital of France is Paris.
```

## Authors

This library was created by [Richard Bagshaw](https://www.richardbagshaw.co.uk).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
