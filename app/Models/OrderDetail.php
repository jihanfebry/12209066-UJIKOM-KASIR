<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_image',
        'product_name',
        'price',
        'stock'
    ];
    

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')
            ->withPivot('quantity', 'unit_price', 'subtotal')
            ->withTimestamps();
    }
}
