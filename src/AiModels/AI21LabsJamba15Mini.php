<?php

declare(strict_types=1);

namespace Shale\Shale\AiModels;

use Aws\Result;
use Shale\Shale\Interfaces\AiModelInterface;

class AI21LabsJamba15Mini implements AiModelInterface
{
    protected array $configuration = [
        'modelId' => 'ai21.jamba-1-5-mini-v1:0',
        'contentType' => 'application/json',
        'accept' => 'application/json',
        'body' => [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => '',
                ],
            ],
            'max_tokens' => 1000,
            'top_p' => 0.8,
            'temperature' => 0.7,
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

        return $result->choices[0]->message->content ?? '';
    }
}
