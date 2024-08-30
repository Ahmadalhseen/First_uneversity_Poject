<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'api_token','phone'
    ];

    protected $hidden = [
         'remember_token', 'api_token',
    ];
    public function Property_Rate(): HasMany
    {
        return $this->hasMany(Property_Rate::class);
    }
    public function cart(): HasMany
    {
        return $this->hasMany(cart::class);
    }
    public function Favorite(): HasMany
    {
        return $this->hasMany(cart::class);
    }
    public function suggestion(): HasMany
    {
        return $this->hasMany(suggestion::class);
    }
    public function user_address(): HasMany
    {
        return $this->hasMany(user_address::class);
    }
    public function Appoitment(): HasMany
    {
        return $this->hasMany(Appoitment::class);
    }
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
