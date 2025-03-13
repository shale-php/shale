<?php

declare(strict_types=1);

namespace Shale\Shale\Interfaces;

use Aws\Result;

interface AiModelInterface
{
    public function getConfiguration(): array;

    public function setMessage(string $message): void;

    public function parseResult(Result $result): string;

    public function isMessageSet(): bool;
}
