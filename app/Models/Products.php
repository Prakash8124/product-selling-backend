<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
    ];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_categories', 'product_id', 'category_id')->withPivotValue([]);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}

