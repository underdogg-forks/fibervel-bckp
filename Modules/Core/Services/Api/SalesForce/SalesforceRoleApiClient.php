<?php

namespace Modules\Core\Services\Api\SalesForce;

use Modules\Core\Services\Api\BaseApiClient;

class SalesforceRoleApiClient extends BaseApiClient
{
    public function createRole(array $payload): array
    {
        return $this->sendPostRequest('/services/data/v57.0/sobjects/UserRole/', $payload);
    }
}
