<?php

namespace Modules\Crm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Crm\Services\Api\Salesforce\SalesforceContactApiClient;

class SyncContactToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $contacts;

    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }

    public function handle(): void
    {
        foreach ($this->contacts as $contact) {
            $dto = (new SalesforceContactApiClient())->syncContact($contact);

            $contact->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

