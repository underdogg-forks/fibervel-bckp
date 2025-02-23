<?php

namespace Modules\Crm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Crm\Services\Api\Salesforce\SalesforceAccountApiClient;

class SyncAccountToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $accounts;

    public function __construct($accounts)
    {
        $this->accounts = $accounts;
    }

    public function handle(): void
    {
        foreach ($this->accounts as $account) {
            $dto = (new SalesforceAccountApiClient())->syncAccount($account);

            $account->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

