<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $primaryKey = 'location_code';
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = [
        'location_code',
        'location_name',
        // add all other fields
    ];
    //creating the relation between Location And SubLocation
     //foreign key=location_code
    //local_key=subLocation_code
    public function subLocations()

    {
        return $this->hasMany(SubLocation::class, 'location_code', 'subLocation_code');//select * from where location_code
    }


    protected $table = 'locations';
}
