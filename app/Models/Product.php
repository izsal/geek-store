<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'weight'
    ];


    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * productSizes
     *
     * @return void
     */
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    /**
     * productImages
     *
     * @return void
     */
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
