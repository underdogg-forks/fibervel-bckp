<?php

namespace Modules\Core\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected static function booted(): void
    {
        static::addGlobalScope('company', function ($query): void {
            if (session('active_company')) {
                $query->where('company_id', session('active_company'));
            }
        });
    }
}
