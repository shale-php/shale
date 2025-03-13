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

    public function prompt(string $message): string
    {
        $this->model->setMessage($message);

        try {
            $response = $this->client->invokeModel($this->model->getConfiguration());
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

        $result = json_decode((string) $response['body']);
        $content = $result->content[0]->text ?? '';

        return $content ?? 'No response from model';
    }
}
