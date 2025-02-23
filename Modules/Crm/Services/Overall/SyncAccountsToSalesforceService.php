<?php

namespace Modules\Crm\Services\Overall;

use Modules\Crm\Jobs\SyncProjectToSalesforceJob;
use Modules\Crm\Models\Account;

class SyncAccountsToSalesforceService
{
    public function sync(Account $account): ?string
    {
        Account::chunk(100, static function ($accounts) {
            dispatch_sync(new SyncProjectToSalesforceJob($accounts));
        });
    }
}
