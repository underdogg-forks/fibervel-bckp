<?php

namespace Modules\Crm\Services\Overall;

use Modules\Crm\Jobs\SyncLeadToSalesforceJob;
use Modules\Crm\Models\Lead;

class SyncLeadsToSalesforceService
{
    public function sync(): ?string
    {
        return Lead::chunk(100, static function ($leads) {
            foreach ($leads as $lead) {
                dispatch_sync(new SyncLeadToSalesforceJob($lead));
            }
        });
    }
}
