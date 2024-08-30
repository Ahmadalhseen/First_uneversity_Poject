<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_multimedia extends Model
{
    protected $fillable = [
        "image_url"
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    protected $table="property_multimedia";
    use HasFactory;
}
