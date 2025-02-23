<?php

namespace Modules\Core\Services\Overall;

use Modules\Crm\Jobs\SyncProjectToSalesforceJob;
use Modules\Crm\Models\Contact;

class SyncRolesToSalesforceService
{
    public function sync(Account $account): ?string
    {
        Account::chunk(100, static function ($accounts) {
            dispatch_sync(new SyncProjectToSalesforceJob($accounts));
        });
    }
}
