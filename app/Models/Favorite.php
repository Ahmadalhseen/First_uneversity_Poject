<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected $table="favorite";
    use HasFactory;
}
