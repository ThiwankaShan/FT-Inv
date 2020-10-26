<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_code';
    public $incrementing = false;
    protected $keyType = "string";

    public function Grn()
    {
        return $this->belongsdTo('App\Grn');
    }
}
