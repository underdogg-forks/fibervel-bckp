<?php

namespace Modules\Crm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Crm\Services\Api\Salesforce\SalesforceLeadApiClient;

class SyncLeadToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $leads;

    public function __construct($leads)
    {
        $this->leads = $leads;
    }

    public function handle(): void
    {
        foreach ($this->leads as $account) {
            $dto = (new SalesforceLeadApiClient())->syncLead($account);

            $account->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

