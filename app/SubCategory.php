<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    
    public $incrementing = false;
    protected $keyType = "string";

    public function category()
    {
    //subcategory belongs to category
    //foreign key=category_code
    //local_key=category code
        return $this->belongsTo(Category::class, 'category_code', 'category_code');
    }
}
