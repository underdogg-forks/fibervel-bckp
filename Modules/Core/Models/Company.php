<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Database\Factories\CompanyFactory;
use Modules\Crm\Models\Account;
use Modules\Crm\Models\Contact;
use Modules\Crm\Models\Lead;
use Modules\Projects\Models\Project;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_users')
            ->withPivot('role');
    }

    protected static function newFactory(): Factory
    {
        return CompanyFactory::new();
    }
}
