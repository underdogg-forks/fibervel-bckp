<?php

namespace Modules\Crm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Crm\Services\Api\Salesforce\SalesforceProjectApiClient;

class SyncProjectToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $projects;

    public function __construct($projects)
    {
        $this->projects = $projects;
    }

    public function handle(): void
    {
        foreach ($this->projects as $account) {
            $dto = (new SalesforceProjectApiClient())->syncProject($account);

            $account->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

