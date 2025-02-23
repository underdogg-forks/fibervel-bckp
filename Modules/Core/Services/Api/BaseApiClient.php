<?php

namespace Modules\Core\Services\Api;

use Modules\Core\Logging\CallLogger;

abstract class BaseApiClient
{
    protected ?CallLogger $callLogger = null;

    public function inject(CallLogger $logger): self
    {
        $this->callLogger = $logger;

        return $this;
    }

    public function request(string $method, string $url, array $data = [])
    {
        if ($this->callLogger) {
            $this->callLogger->log($method, $url, $data);
        }

        return $this->request($method, $url, $data);
    }
}
