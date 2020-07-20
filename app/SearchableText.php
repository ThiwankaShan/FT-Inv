<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class SearchableText extends Model
{
    use SearchableTrait;
    protected $searchable = [
        'columns' => [
            'items.item_code'=>9,
            'divisions.division_name'=>10,
            'sub_divisions.subDivision_name'=>10,
            'categories.category_name'=>10,
            'sub_categories.subCategory_name'=>10,
        ]

    ];

    protected $fillable = [
        'item_code','division_name','subDivision_name','category_name','subCategory_name',
    ];
}
