<?php

namespace Modules\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Core\Services\Api\SalesForce\SalesforceUserApiClient;

class SyncUsersToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function handle(): void
    {
        foreach ($this->users as $user) {
            $dto = (new SalesforceUserApiClient())->syncUser($user);

            $user->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

