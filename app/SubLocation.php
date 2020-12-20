<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLocation extends Model
{
    protected $table = 'sub_locations';
    protected $primaryKey = 'subLocation_code';
    public $incrementing = false;
    protected $keyType = "string";
    
    protected $fillable = [
        'subLocation_code',
        'subLocation_name',
        'location_code',
    ];

    public function locations()
    {
        return $this->belongsTo('App\Location','location_code');
    }

    public function items()
    {
        return $this->hasMany('App\Items');
    }
    
}
