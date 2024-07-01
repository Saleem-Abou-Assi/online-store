<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
    ];
    public function product_cart(){
        return $this->hasMany(ProductCart::class);
    }
    public function order_history()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
