<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('accounts')->cascadeOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->cascadeOnDelete();
            $table->string('salesforce_id')->nullable();
            $table->string('status'); // Open, Completed, Overdue, etc.
            $table->string('subject');
            $table->tinyText('description');
            $table->dateTime('due_at')->nullable();
            $table->timestamps();
        });
    }
};
