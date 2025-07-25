<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JaOcero\FilaChat\Traits\HasFilaChat;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory;
    use HasFilaChat;
    use HasPanelShield;
    use HasRoles;
    use HasTranslations;
    use Notifiable;
    use SoftDeletes;

    public array $translatable = ['name'];

    protected $fillable = [
        'civil_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->assignRole('panel_user');
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole('super_admin'),
            'entity' => $this->hasRole('super_admin') || $this->hasRole('entity'),
            'user' => $this->hasRole('super_admin') || $this->hasRole('panel_user'),
            default => true,
        };
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function entity(): HasOne
    {
        return $this->hasOne(Entity::class, 'user_id');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return optional($this->profile)->avatar
            ? '/uploads/'.$this->profile->avatar
            : asset('assets/images/unset.jpg');
    }

    public function rating(): HasMany
    {
        return $this->hasMany(ProfileRating::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
