<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->cascadeOnDelete();
            $table->string('salesforce_id')->nullable();
            $table->string('project_stage')->nullable(); // Prospecting, Negotiation, Closed-Won, etc.
            $table->string('name')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('closed_at')->nullable();
            $table->timestamps();
        });
    }
};
