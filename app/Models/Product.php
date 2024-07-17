<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $appends = ['category_name','image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCategoryNameAttribute()
    {
        return $this->category()->value('name');
    }

    public function getImagePathAttribute()
    {
        return  $this->image == null ? null : url('admin/products/' .$this->image);
    }
}
