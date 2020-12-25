<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
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
