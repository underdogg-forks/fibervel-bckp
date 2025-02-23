<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Modules\Core\Services\Overall\SyncUsersToSalesforceService;
use Modules\Crm\Services\Overall\SyncAccountsToSalesforceService;
use Modules\Crm\Services\Overall\SyncContactsToSalesforceService;
use Modules\Crm\Services\Overall\SyncLeadsToSalesforceService;
use Modules\Crm\Services\Overall\SyncProjectsToSalesforceService;
use Modules\Crm\Services\Overall\SyncTasksToSalesforceService;

class SyncSalesforceCommand extends Command
{
    protected $signature = 'sync:salesforce';
    protected $description = 'Sync accounts, users, leads, contacts, projects, and tasks to Salesforce';

    public function handle(): void
    {
        $this->info('Dispatching Salesforce sync jobs...');

        app(SyncAccountsToSalesforceService::class)->sync();
        $this->info('Accounts sync dispatch_synced.');

        app(SyncUsersToSalesforceService::class)->sync();
        $this->info('Users sync dispatch_synced.');

        app(SyncLeadsToSalesforceService::class)->sync();
        $this->info('Leads sync dispatch_synced.');

        app(SyncContactsToSalesforceService::class)->sync();
        $this->info('Contacts sync dispatch_synced.');

        app(SyncProjectsToSalesforceService::class)->sync();
        $this->info('Projects sync dispatch_synced.');

        app(SyncTasksToSalesforceService::class)->sync();
        $this->info('Tasks sync dispatch_synced.');

        $this->info('All Salesforce sync jobs have been dispatch_synced.');
    }
}
