<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $primaryKey = 'item_code';
    public $incrementing = false;
    protected $keyType = "string";

}
