<?php

namespace Modules\Core\Services\Api\SalesForce;

use Modules\Core\Services\Api\BaseApiClient;

class SalesforceUserApiClient extends BaseApiClient
{
    public function createUser(array $payload): array
    {
        return $this->sendPostRequest('/services/data/v57.0/sobjects/User/', $payload);
    }
}
