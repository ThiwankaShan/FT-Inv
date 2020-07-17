<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
  protected $primaryKey='sc_id';
  
  //creating the relation between Division And SubCategory
   public function division(){
    return $this->belongsTo('App\Division');
  }

    //creating the relation between subdivision And subcategory
    public function subdivision(){
    return $this->belongsTo('App\SubDivision');
    }

    //creating the relation between Category And subcategory
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
