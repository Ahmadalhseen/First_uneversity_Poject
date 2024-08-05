<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property_Rate extends Model
{    protected $table="property_rates";
    use HasFactory;
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
