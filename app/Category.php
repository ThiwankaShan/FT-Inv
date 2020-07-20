<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey='category_id';
    public $incrementing=false;
    protected $keyType="string";

    //creating the relation between Division And Category
    // public function division()
    // {
    //     return $this->belongsTo('App\Division');
    // }

    //creating the relation between subdivision And category
    // public function subdivision()
    // {
    //     return $this->belongsTo('App\SubDivision');
    // }

    //creating the relation between Category And subcategory
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
