<?php

declare(strict_types=1);

namespace Shale\Shale;

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Shale\Shale\Interfaces\AiModelInterface;

class ShaleCore
{
    protected AiModelInterface $model;

    protected string $modelId;

    public function __construct(
        protected BedrockRuntimeClient $client,
    ) {
        //
    }

    public function using(AiModelInterface $model): self
    {
        $this->model = $model;

        $this->modelId = $model->getModelId();

        return $this;
    }

    public function prompt(string $message): self
    {
        $this->model->setMessage($message);

        return $this;
    }

    public function execute(): string
    {
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
