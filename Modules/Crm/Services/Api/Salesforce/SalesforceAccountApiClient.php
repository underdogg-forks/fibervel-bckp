<?php

namespace Modules\Crm\Services\Api\Salesforce;

use Modules\Core\Services\Api\BaseApiClient;

class SalesforceAccountApiClient extends BaseApiClient
{
    public function createAccount(array $payload): array
    {
        return $this->sendPostRequest('/services/data/v57.0/sobjects/Account/', $payload);
    }
}
