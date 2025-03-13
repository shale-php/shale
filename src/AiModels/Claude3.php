<?php

declare(strict_types=1);

namespace Shale\Shale\AiModels;

use Shale\Shale\Interfaces\AiModelInterface;

class Claude3 implements AiModelInterface
{
    protected array $configuration = [
        'contentType' => 'application/json',
        'modelId' => 'anthropic.claude-3-haiku-20240307-v1:0',
        'body' => [
            'anthropic_version' => 'bedrock-2023-05-31',
            'max_tokens' => 512,
            'temperature' => 0.5,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => '',
                ],
            ],
        ],
    ];

    private function __construct()
    {
        // private constructor to prevent instantiation outside
        // of the make method.
    }

    public static function make(): self
    {
        return new self;
    }

    /**
     * @return array<string, mixed>
     */
    public function getConfiguration(): array
    {
        $this->configuration['body'] = json_encode($this->configuration['body']);

        return $this->configuration;
    }

    public function getModelId(): string
    {
        return $this->configuration['modelId'];
    }

    public function setMessage(string $message): void
    {
        $this->configuration['body']['messages'][0]['content'] = $message;
    }
}
