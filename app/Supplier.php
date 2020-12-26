<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_code';
    public $incrementing = false;
    protected $keyType = "integer";

    protected $fillable = ['supplier_code',
                           'supplier_name',
                           'supplier_address',
                           'telephone_number',
                           'email',
                           'vat_register_no',
                        ];
                        
    public function grns()
    {
        return $this->hasMany('App\Grn');
    }

    public function items()
    {
        return $this->hasMany('App\Items');
    }
}
