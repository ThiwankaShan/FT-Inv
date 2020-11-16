<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $primaryKey = 'item_code';
    public $incrementing = false;
    protected $keyType = "string";
    public function location()
    {
        return $this->belongsTo('App\Division');
    }

    //creating the relation between subdivision And items
    public function subLocation()
    {
        return $this->belongsTo('App\SubDivision');
    }

    //creating the relation between Category And item
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
