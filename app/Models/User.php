<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
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

class User extends Authenticatable implements HasAvatar
{
    use HasFactory;
    use HasFilaChat;
    use HasPanelShield;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole('super_admin'),
            'entity' => $this->hasRole('super_admin') || $this->hasRole('entity'),
            'user' => $this->hasRole('super_admin') || $this->hasRole('panel_user'),
            default => false,
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
            ? '/storage/'.$this->profile->avatar
            : asset('images/default-avatar.png');
    }

    public function rating(): HasMany
    {
        return $this->hasMany(ProfileRating::class);
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
