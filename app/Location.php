<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $primaryKey = 'location_code';
    public $incrementing=false;
    protected $keyType="string";

    protected $fillable = [
        'location_code',
        'location_name',
        // add all other fields
    ];
    //creating the relation between Location And SubLocation
    public function subLocation()
    {
        return $this->hasMany('App\SubLocation');
    }

    //creating the relation between Location And Category
    public function category()
    {
        return $this->hasMany('App\Category');
    }

    //creating the relation between Location And subcategory
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }
    protected $table = 'locations';
}
