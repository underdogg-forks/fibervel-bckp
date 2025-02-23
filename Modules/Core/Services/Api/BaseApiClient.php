<?php

namespace Modules\Core\Services\Api;

use App\Enums\RequestMethod;
use Modules\Core\Logging\CallLogger;

abstract class BaseApiClient
{
    protected ?CallLogger $callLogger = null;

    public function inject(CallLogger $logger): self
    {
        $this->callLogger = $logger;

        return $this;
    }

    public function sendGetRequest(string $endpoint, array $parameters = [], array $headers = []): ?array
    {
        return $this->request(RequestMethod::GET, $endpoint, $parameters, $headers);
    }

    public function sendPutRequest(string $endpoint, array $payload = [], array $headers = []): ?array
    {
        return $this->request(RequestMethod::PUT, $endpoint, $payload, $headers);
    }

    public function sendPostRequest(string $endpoint, array $payload = [], array $headers = []): ?array
    {
        return $this->request(RequestMethod::POST, $endpoint, $payload, $headers);
    }

    public function sendDeleteRequest(string $endpoint, array $payload = [], array $headers = []): ?array
    {
        return $this->request(RequestMethod::DELETE, $endpoint, $payload, $headers);
    }

    public function request(RequestMethod $method, string $url, array $data = [])
    {
        if ($this->callLogger) {
            $this->callLogger->log($method, $url, $data);
        }

        return $this->request($method, $url, $data);
    }
}
