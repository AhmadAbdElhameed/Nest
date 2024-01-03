<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{

    public function saving(Category $category)
    {
        if ($category->isDirty('name')) { // If the name has changed
            $category->slug = $category->createSlug($category->name);
        }
    }

}
