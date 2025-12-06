<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'category_id',
        'price',
        'stock',
        'image',
        'active',
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->sku)) {
                $model->sku = 'SKU-' . strtoupper(Str::random(8));
            }
        });
    }
}
