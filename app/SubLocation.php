<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLocation extends Model
{
    protected $fillable = [
        'location_code',
        'subLocation_code',
        'subLocation_name',
        // add all other fields
    ];

    protected $primaryKey = ['subLocation_code','location_code'];
    public $incrementing = false;
    protected $keyType = "string";


    public function location()
    {
    //subLocation belongs to location
    //foreign key=location_code
    //local_key=location_code
        return $this->belongsTo(Location::class, 'location_code', 'location_code');
    }

    protected $table = 'sub_locations';
}
