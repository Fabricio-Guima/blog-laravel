<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
     /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->url = Str::kebab($product->name);
        $product->uuid = Str::uuid();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->url = Str::kebab($product->name);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
