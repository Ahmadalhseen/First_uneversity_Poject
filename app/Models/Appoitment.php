<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appoitment extends Model
{
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    protected $table="appointments";
    use HasFactory;
}
