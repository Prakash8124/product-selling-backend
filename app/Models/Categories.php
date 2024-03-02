<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductCategories;
use App\Models\Products;

class Categories extends Model
{
    use HasFactory;

    /**
     * Get the product_id associated with the category.
     */
    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_categories', 'category_id', 'product_id');
    }
    
}
