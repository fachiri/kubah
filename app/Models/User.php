<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public static function booted() {
        static::creating(function ($model) {
            $model->ulid = Str::ulid();
        });
    }

    protected $fillable = [
        'name',
        'phone',
        'address',
        'birth_place',
        'birth_date',
        'gender',
        'avatar',
        'email',
        'password',
        'device_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function manager(): HasOne
    {
        return $this->hasOne(Manager::class);
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function volunteer(): HasOne
    {
        return $this->hasOne(Volunteer::class);
    }

    public function common_user(): HasOne
    {
        return $this->hasOne(CommonUser::class);
    }

    public function isManager(): bool
    {
        return isset($this->manager);
    }

    public function isAdmin(): bool
    {
        return isset($this->admin);
    }

    public function isVolunteer(): bool
    {
        return isset($this->volunteer);
    }

    public function isCommonUser(): bool
    {
        return isset($this->common_user);
    }

    public function routeNotificationForFcm()
    {
        return $this->device_token; // Pastikan kolom device_token ada di tabel users
    }
}
