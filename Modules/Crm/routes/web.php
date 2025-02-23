<?php

use Illuminate\Support\Facades\Route;
use Modules\Crm\Http\Controllers\CrmController;

Route::group([], function (): void {
    Route::resource('crm', CrmController::class)->names('crm');
});
