<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'location_code';
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = [
        'location_code',
        'location_name',
    ];

    public function subLocations()
    {
        return $this->hasMany('App\subLocation');
    }

    public function items()
    {
        return $this->hasMany('App\Items');
    }
    
}
