<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateProductSlugs extends Command
{
    protected $signature = 'products:update-slugs';
    protected $description = 'Update missing product slugs';

    public function handle()
    {
        $products = Product::whereNull('slug')->orWhere('slug', '')->get();
        
        $count = 0;
        foreach ($products as $product) {
            $product->slug = Str::slug($product->name);
            $product->save();
            $count++;
        }
        
        $this->info("Updated {$count} product slugs");
    }
}
