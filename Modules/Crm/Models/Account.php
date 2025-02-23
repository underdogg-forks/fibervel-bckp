<?php

namespace Modules\Crm\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Modules\Crm\Database\Factories\AccountFactory;
use Modules\Projects\Models\Project;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    protected static function newFactory(): Factory
    {
        return AccountFactory::new();
    }
}
