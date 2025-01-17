<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{   
    use SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'category_code';
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = ['category_code','category_name'];


    public function subcategories()
    {
        return $this->hasMany('App\subCategory');
    }

    public function items()
    {
        return $this->hasMany('App\Items');
    }
}
