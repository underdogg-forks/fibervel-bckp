<?php

namespace Modules\Crm\Services\Overall;

use Modules\Crm\Jobs\SyncProjectToSalesforceJob;
use Modules\Projects\Models\Project;

class SyncProjectsToSalesforceService
{
    public function sync(): ?string
    {
        return Project::chunk(100, function ($projects) {
            foreach ($projects as $project) {
                dispatch_sync(new SyncProjectToSalesforceJob($project));
            }
        });
    }
}
