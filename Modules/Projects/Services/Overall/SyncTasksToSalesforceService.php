<?php

namespace Modules\Crm\Services\Overall;

use Modules\Crm\Jobs\SyncTaskToSalesforceJob;
use Modules\Projects\Models\Task;

class SyncTasksToSalesforceService
{
    public function sync(): ?string
    {
        return Task::chunk(100, function ($tasks) {
            foreach ($tasks as $task) {
                dispatch_sync(new SyncTaskToSalesforceJob($task));
            }
        });
    }
}
