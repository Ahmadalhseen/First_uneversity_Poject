<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'area',
        'bedroom',
        'bathroom',
        'location',
        'direction',
        'view',
        'condition',
        'grade',
        'user_id',
        'main_image_url',
    ];

   
    protected $table="properties";
    use HasFactory;
    public function multimedia(): HasMany
    {
        return $this->hasMany(property_multimedia::class);
    }
    public function property_Location(): HasMany
    {
        return $this->hasMany(Property_Location::class);
    }
    public function property_Rate(): HasMany
    {
        return $this->hasMany(Property_Rate::class);
    }
    public function Favorite(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
    public function cart(): HasMany
    {
        return $this->hasMany(cart::class);
    }
    public function Appoitment(): HasMany
    {
        return $this->hasMany(Appoitment::class);
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
