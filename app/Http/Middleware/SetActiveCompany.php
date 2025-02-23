<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetActiveCompany
{
    public function handle(Request $request, Closure $next)
    {
        if ( ! session()->has('active_company') && auth()->check()) {
            $company = auth()->user()?->companies()->first();
            if ($company) {
                session(['active_company' => $company->id]);
            }
        }

        return $next($request);
    }
}
