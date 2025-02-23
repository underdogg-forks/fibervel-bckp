<?php

namespace Modules\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Core\Services\Api\SalesForce\SalesforceRoleApiClient;

class SyncRolesToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    public function handle(): void
    {
        foreach ($this->roles as $role) {
            $dto = (new SalesforceRoleApiClient())->syncRole($role);

            $role->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

