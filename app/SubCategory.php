<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $primaryKey ='subCategory_code';
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = ['subCategory_code',
                           'subCategory_name',
                           'category_code'
                        ];

    public function category()
    {
        return $this->belongsTo('App\Category','category_code');
    }
    
    public function items()
    {
        return $this->hasMany('App\Items');
    }
}
