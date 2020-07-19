<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    protected $primaryKey = 'd_id';

    //creating the relation between Division And SubDivision
    public function subdivision()
    {
        return $this->hasMany('App\SubDivision');
    }

    //creating the relation between Division And Category
    public function category()
    {
        return $this->hasMany('App\Category');
    }

    //creating the relation between Division And subcategory
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
