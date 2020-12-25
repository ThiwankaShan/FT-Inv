<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grn extends Model
{
    use SoftDeletes;
    protected $table = 'grns';
    protected $primaryKey = 'GRN_number';
    public $incrementing = false;
    protected $keyType = "integer";

    protected $fillable = ['GRN_number','GRN_date','invoice_number','invoice_date','supplier_code'];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_code');
    }

    public function items()
    {
        return $this->hasMany('App\Items');
    }
}
