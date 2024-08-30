<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_address extends Model
{
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected $table="user_addresses";
    use HasFactory;
}
