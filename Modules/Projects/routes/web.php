<?php

use Illuminate\Support\Facades\Route;
use Modules\Projects\Http\Controllers\ProjectsController;

Route::group([], function (): void {
    Route::resource('projects', ProjectsController::class)->names('projects');
});
