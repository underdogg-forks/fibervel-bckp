<?php

namespace Modules\Core\Services\Overall;

use Modules\Core\Jobs\SyncUsersToSalesforceJob;
use Modules\Core\Models\User;

class SyncUsersToSalesforceService
{
    public function syncAllUsers(): ?string
    {
        return User::chunk(100, static function ($users) {
            dispatch_sync(new SyncUsersToSalesforceJob($users));
        });
    }
}
