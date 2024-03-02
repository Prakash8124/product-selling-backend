<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;


    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'id');
    }

}
