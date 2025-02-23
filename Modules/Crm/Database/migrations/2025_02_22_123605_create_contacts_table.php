<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->cascadeOnDelete();
            $table->string('salesforce_id')->nullable();
            $table->string('contact_type')->nullable();
            $table->string('job_title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }
};
