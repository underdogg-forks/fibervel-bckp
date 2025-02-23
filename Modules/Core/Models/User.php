<?php

namespace Modules\Core\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Core\Database\Factories\UserFactory;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\ProjectUser;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use HasSuperAdmin;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_users')
            ->using(CompanyUser::class)->withPivot('role');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_users')
            ->using(ProjectUser::class)
            ->withPivot('role');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // TODO: Implement canAccessPanel() method.
        return true;
    }

    public function getActiveCompany(): ?Company
    {
        return session('active_company') ? Company::find(session('active_company')) : null;
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
