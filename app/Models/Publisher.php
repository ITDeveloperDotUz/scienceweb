<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class Publisher extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'type',
        'tin',
        'country_code',
        'state',
        'postal_code',
        'address',
        'email',
        'preferred_locale',
        'phone',
        'affiliate_person',
        'bank_account',
        'bank_name',
        'bank_code',
        'website','password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $guard_name = 'publisher';
    protected $guard = 'publisher';

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id');
    }
}
