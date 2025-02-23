<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('company_id');
            $table->string('salesforce_id')->nullable(); // Salesforce External ID
            $table->string('type')->nullable(); // Customer, Partner, Vendor, etc.
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();

            $table
                ->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
};
