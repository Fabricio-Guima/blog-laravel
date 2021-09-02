<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
     /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->url = Str::kebab($category->name);
        $category->uuid = Str::uuid();
    }



     /**
     * Handle the plan "updating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        $category->url = Str::kebab($category->name);
    }
}
