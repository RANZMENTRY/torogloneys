<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
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
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
    
    public function scopeWithCategory($query)
    {
        return $query->with('category');
    }
    
    public function scopeFeatured($query, $limit = 6)
    {
        return $query->active()
            ->inStock()
            ->latest()
            ->limit($limit);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->sku)) {
                $model->sku = 'SKU-' . strtoupper(Str::random(8));
            }
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
