<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_price',
        'discount',
        'final_price',
        'amount_paid',
        'change',
        'user_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity', 'unit_price', 'subtotal')
            ->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
