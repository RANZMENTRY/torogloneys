<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'total_amount', 'status', 'created_at'];
    
    protected $dates = ['created_at', 'updated_at'];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
