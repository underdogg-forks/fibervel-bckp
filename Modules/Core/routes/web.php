<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Models\User;

Route::group([], function (): void {
    Route::resource('core', CoreController::class)->names('core');
});

Route::get('/company/switch/{company}', function ($companyId) {
    $user = Auth::user();

    if ( ! $user) {
        abort(403, 'Unauthorized');
    }

    /** @var User $user */
    if ($user->companies->contains('id', $companyId)) {
        session(['active_company' => $companyId]);
    }

    return back();
})->name('company.switch')->middleware('auth');
