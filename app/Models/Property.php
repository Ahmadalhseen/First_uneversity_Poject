<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Property extends Model
{
    protected $table="properties";
    use HasFactory;
    public function property_Images(): HasMany
    {
        return $this->hasMany(Property_Images::class);
    }
    public function property_Location(): HasMany
    {
        return $this->hasMany(Property_Location::class);
    }
    public function property_Rate(): HasMany
    {
        return $this->hasMany(Property_Rate::class);
    }
}
