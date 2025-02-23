<?php

namespace Modules\Projects\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Projects\Enums\ProjectRoleEnum;

class ProjectUser extends Pivot
{
    protected $table = 'project_users';

    protected $guarded = [];

    protected $casts = [
        'role' => ProjectRoleEnum::class,
    ];

    public function getFormattedRoleAttribute(): string
    {
        return ucfirst($this->role->value);
    }

    public function scopeManagers($query)
    {
        return $query->where('role', 'project-manager');
    }
}
