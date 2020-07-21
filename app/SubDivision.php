<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDivision extends Model
{
    protected $primaryKey = 'subDivision_id';
    public $incrementing=false;
    protected $keyType="string";

    ///creating the relation between Division And SubDivision
    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    //creating the relation between Subdivision And Category
    public function category()
    {
        return $this->hasMany('App\Category');
    }

    //creating the relation between Subdivision And subcategory
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
