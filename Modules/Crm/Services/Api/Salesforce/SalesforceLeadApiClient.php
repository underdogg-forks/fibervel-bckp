<?php

namespace Modules\Crm\Services\Api\Salesforce;

use Modules\Core\Services\Api\BaseApiClient;

class SalesforceLeadApiClient extends BaseApiClient
{
    public function createLead(array $payload): array
    {
        return $this->sendPostRequest('/services/data/v57.0/sobjects/Lead/', $payload);
    }
}
