<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Property_Location extends Model
{   protected $table="property_location";
    use HasFactory;
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
