<?php

declare(strict_types=1);

namespace Shale\Shale;

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Shale\Shale\Exceptions\AiMessageNotSetException;
use Shale\Shale\Exceptions\AiModelNotSetException;
use Shale\Shale\Interfaces\AiModelInterface;

class ShaleCore
{
    protected AiModelInterface $model;

    public function __construct(
        protected BedrockRuntimeClient $client,
    ) {
        //
    }

    public function using(AiModelInterface $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function prompt(string $message): self
    {
        $this->checkModelSet();

        $this->model->setMessage($message);

        return $this;
    }

    public function execute(): string
    {
        $this->checkModelSet();
        $this->checkMessageSet();

        $result = $this->client->invokeModel(
            $this->model->getConfiguration()
        );

        return $this->model->parseResult($result);
    }

    private function checkModelSet(): void
    {
        if (! isset($this->model)) {
            throw new AiModelNotSetException('Model not set');
        }
    }

    private function checkMessageSet(): void
    {
        if (! $this->model->isMessageSet()) {
            throw new AiMessageNotSetException('Message not set');
        }
    }
}
