<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    protected $primaryKey = 'GRN_no';
    public $incrementing = false;
    protected $keyType = "string";

    public function suppliers()
    {
        return $this->hasMany('App\Supplier');
    }
}
