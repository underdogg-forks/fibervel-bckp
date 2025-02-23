<?php

namespace Modules\Crm\Services\Api\Salesforce;

use Modules\Core\Services\Api\BaseApiClient;

class SalesforceTaskApiClient extends BaseApiClient
{
    public function createTask(array $data): array
    {
        return $this->sendPostRequest('/services/data/v57.0/sobjects/Task/', $data);
    }
}
