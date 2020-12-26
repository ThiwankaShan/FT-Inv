<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model
{
    use SoftDeletes;
    protected $table = 'items';
    protected $primaryKey = 'item_code';
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = ['item_code',
                           'location_code',
                           'subLocation_code',
                           'category_code',
                           'subCategory_code',
                           'type',
                           'serial_number',
                           'model_number',
                           'brandName',
                           'GRN_number',
                           'procument_id',
                           'purchased_date',
                           'supplier_name',
                           'tax',
                           'gross_price',
                           'net_price'
                        ];

    public function GRN()
    {
        return $this->belongsTo('App\Grn', 'GRN_number');
    }

    public function locations()
    {
        return $this->belongsTo('App\Location', 'location_code');
    }

    public function subLocations()
    {
        return $this->belongsTo('App\SubLocation', 'subLocation_code');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_code');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'subCategory_code');
    }

}
