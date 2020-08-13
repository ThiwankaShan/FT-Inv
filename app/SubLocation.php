<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subLocation extends Model
{
    protected $primaryKey = 'subLocation_code';
    public $incrementing=false;
    protected $keyType="string";

    ///creating the relation between Division And subLocation
    public function division()
    {
        return $this->belongsTo('App\Location');
    }

    //creating the relation between subLocation And Category
    public function category()
    {
        return $this->hasMany('App\Category');
    }

    //creating the relation between subLocation And subcategory
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}