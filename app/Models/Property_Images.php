<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Property_Images extends Model
{
    protected $table="property_images";
    use HasFactory;
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
