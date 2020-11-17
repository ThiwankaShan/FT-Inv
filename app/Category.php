<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_code';
    public $incrementing = false;
    protected $keyType = "string";



    //creating the relation between Category And subcategory
    //foreign key=category_code
    //local_key=category code
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_code', 'subCategory_code');
    }
}
