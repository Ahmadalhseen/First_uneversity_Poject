<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suggestion extends Model
{
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected $table="suggestions";
    use HasFactory;
}
