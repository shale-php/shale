<?php

declare(strict_types=1);

namespace Shale\Shale\Interfaces;

interface AiModelInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getConfiguration(): array;

    public function getModelId(): string;

    public function setMessage(string $message): void;
}
