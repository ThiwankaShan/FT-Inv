<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemQuantity;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $result=ItemQuantity::where('item_code', 'like', '%'.$request->get('searchQuerry').'%')
        ->orwhere('q_name', 'like', '%'.$request->get('searchQuerry').'%')
        ->orwhere('d_id', 'like', '%'.$request->get('searchQuerry').'%')
        ->orwhere('sd_id', 'like', '%'.$request->get('searchQuerry').'%')
        ->orwhere('c_id', 'like', '%'.$request->get('searchQuerry').'%')
        ->take(10)
        ->get();

        return json_encode($result);
    }
}
