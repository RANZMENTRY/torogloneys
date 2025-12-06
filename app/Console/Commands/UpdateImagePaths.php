<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class UpdateImagePaths extends Command
{
    protected $signature = 'images:update-paths';
    protected $description = 'Update image paths to add products/ prefix if needed';

    public function handle()
    {
        $products = Product::whereNotNull('image')->get();

        foreach ($products as $product) {
            if (!str_starts_with($product->image, 'products/')) {
                $product->image = 'products/' . $product->image;
                $product->save();
                $this->info("Updated: " . $product->name . " => " . $product->image);
            } else {
                $this->comment("Already has prefix: " . $product->name);
            }
        }

        $this->info("Done!");
    }
}
?>
