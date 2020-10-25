<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_code';
    public $incrementing = false;
    protected $keyType = "string";



    //creating the relation between Category And subcategory
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
