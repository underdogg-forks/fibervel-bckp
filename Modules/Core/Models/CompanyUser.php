<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyUser extends Pivot
{
    protected $table = 'company_users';

    protected $guarded = [];

    public function getFormattedRoleAttribute(): string
    {
        return ucfirst($this->role);
    }

    public function scopeManagers($query)
    {
        return $query->where('role', 'manager');
    }
}
