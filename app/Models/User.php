<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Support\Facades\Hash;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable;

    const ROLE_SUPER_ADMIN = 'SUPER_ADMIN';
    const ROLE_SECRETARY = 'SECRETARY';
    const ROLE_USER = 'USER';
    const ROLE_DEFAULT = self::ROLE_USER;

    const ROLES = [
        self::ROLE_SUPER_ADMIN => 'Super_Admin',
        self::ROLE_SECRETARY => 'Secretary',
        self::ROLE_USER => 'User',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_super_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts (): array
    {
        return [
        'email_verified_at' => 'datetime',
        'password'=>'hashed',
        'is_super_admin' => 'boolean',
    ];
    }   

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isSuperAdmin() || $this->isSecretary() || $this->isUser();
    }

    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isSecretary()
    {
        return $this->role === self::ROLE_SECRETARY;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }
    
}
