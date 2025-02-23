<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('corporations', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }
};
