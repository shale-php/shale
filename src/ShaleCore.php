<?php

declare(strict_types=1);

namespace Shale\Shale;

use Aws\BedrockRuntime\BedrockRuntimeClient;
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
        if (! isset($this->model)) {
            throw new \Exception('Model not set');
        }

        $this->model->setMessage($message);

        return $this;
    }

    public function execute(): string
    {
        if (! isset($this->model)) {
            throw new \Exception('Model not set');
        }

        if (! $this->model->isMessageSet()) {
            throw new \Exception('Message not set');
        }

        try {
            $result = $this->client->invokeModel(
                $this->model->getConfiguration()
            );
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

        return $this->model->parseResult($result);
    }
}
