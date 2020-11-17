<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    protected $primaryKey = 'GRN_no';
    public $incrementing = false;
    protected $keyType = "string";

    //GRN belongs to supplier
    //foreign key=supplier_code
    //local key=supplier_code
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'supplier_code');
    }
}
