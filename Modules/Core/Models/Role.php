<?php

namespace Modules\Core\Models;

class Role extends \Spatie\Permission\Models\Role
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
