<?php

namespace Modules\Crm\Services\Overall;

use Modules\Crm\Jobs\SyncContactToSalesforceJob;
use Modules\Crm\Models\Contact;

class SyncContactsToSalesforceService
{
    public function sync(Contact $contact): ?string
    {
        return Contact::chunk(100, function ($contacts) {
            foreach ($contacts as $contact) {
                dispatch_sync(new SyncContactToSalesforceJob($contact));
            }
        });
    }
}
