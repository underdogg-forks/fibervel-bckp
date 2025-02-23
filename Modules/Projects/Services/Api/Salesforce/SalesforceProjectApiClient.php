<?php

namespace Modules\Crm\Services\Api\Salesforce;

use Modules\Core\Services\Api\BaseApiClient;

class SalesforceProjectApiClient extends BaseApiClient
{
    public function createProject(array $payload): array
    {
        return $this->sendPostRequest('/services/data/v57.0/sobjects/Opportunity/', $payload);
    }
}
