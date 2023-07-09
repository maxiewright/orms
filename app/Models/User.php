<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected static function booted()
    {
        static::creating(fn(User $user) => [
            $user->username = $user->serviceperson_number,
            $user->password = bcrypt('Password1')
        ]);

        static::created(function (User $user) {
            $serviceperson = $user->serviceperson;
            $userName = $serviceperson->number.
                Str::lower($serviceperson->last_name).
                Str::lower(Str::substr($serviceperson->first_name, 0, 1));

            $user->update([
               'username' => $userName,
            ]);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'serviceperson_number',
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
        'password_changed_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class);
    }

    public function canAccessFilament(): bool
    {
//        return str_ends_with($this->email, '@ttdf.mil.tt');
        return true;
    }

    public function passwordChanged(): bool
    {
        return (bool) $this->password_changed_at;
    }
}
