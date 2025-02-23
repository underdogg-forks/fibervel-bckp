<?php

namespace Modules\Crm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Crm\Services\Api\Salesforce\SalesforceTaskApiClient;

class SyncTaskToSalesforceJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function handle(): void
    {
        foreach ($this->tasks as $task) {
            $dto = (new SalesforceTaskApiClient())->syncTask($task);

            $task->update(['salesforce_id' => $dto->getId()]);
        }
    }
}

