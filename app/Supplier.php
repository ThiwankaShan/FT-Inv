<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_code';
    public $incrementing = false;
    protected $keyType = "integer";

    //Create relation between supplier and grn
    //foreign key=supplier_code
    //local key=GRN_no
    public function grns()
    {
        return $this->hasMany(Grn::class, 'supplier_code', 'GRN_number');
    }
}
