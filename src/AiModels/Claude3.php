<?php

declare(strict_types=1);

namespace Shale\Shale\AiModels;

use Aws\Result;
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

    public static function make(): self
    {
        return new self;
    }

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

    public function isMessageSet(): bool
    {
        return ! empty($this->configuration['body']['messages'][0]['content']);
    }

    public function parseResult(Result $result): string
    {
        $result = json_decode((string) $result['body']);

        return $result->content[0]->text ?? '';
    }
}
