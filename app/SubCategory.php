<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $primaryKey = 'subCategory_code';
    public $incrementing = false;
    protected $keyType = "string";

    //subcategory belongs to category
    //foreign key=category_code
    //local_key=category code
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_code', 'category_code');
    }
}
