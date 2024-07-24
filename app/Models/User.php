<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use App\Models\Concerns\Filterable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static string $generateSlugFromField = 'name';

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function hasRole($role): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRoleEnum::ADMIN->value;
    }
}
