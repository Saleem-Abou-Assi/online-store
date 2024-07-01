<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function product_cart():HasMany
    {
        return $this->hasMany(ProductCart::class);
    }
}
