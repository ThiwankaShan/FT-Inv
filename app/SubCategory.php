<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

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

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }


    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
