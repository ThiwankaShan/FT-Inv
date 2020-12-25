<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
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
