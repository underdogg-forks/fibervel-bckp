<?php

namespace Modules\Projects\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Crm\Models\Account;
use Modules\Projects\Database\Factories\ProjectFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users')
            ->using(ProjectUser::class)
            ->withPivot('role');
    }

    protected static function newFactory(): Factory
    {
        return ProjectFactory::new();
    }
}
