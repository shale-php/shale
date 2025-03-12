<?php

declare(strict_types=1);

namespace Bagwaa\ShaleAi;

use Aws\BedrockRuntime\BedrockRuntimeClient;

class ShaleCore
{
    public function __construct(
        protected BedrockRuntimeClient $client,
        protected string $modelId
    ) {
        //
    }

    public function prompt(string $message): string
    {
        $body = [
            'anthropic_version' => 'bedrock-2023-05-31',
            'max_tokens' => 512,
            'temperature' => 0.5,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message,
                ],
            ],
        ];

        try {
            $response = $this->client->invokeModel([
                'contentType' => 'application/json',
                'modelId' => $this->modelId,
                'body' => json_encode($body),
            ]);
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

        $result = json_decode((string) $response['body']);
        $content = $result->content[0]->text ?? '';

        return $content ?? 'No response from model';
    }
}
