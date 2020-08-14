<?php

namespace App\Http\Controllers;

use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use Illuminate\Http\Request;

class LiveSearchController extends Controller
{
    public function autofill(Request $request)
    {
        if ($request->get('searchQuerry') != null) {
            $itemResult = Items::where('item_code', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('item_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('Location_id', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('subLocation_id', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('category_id', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(5)
                ->get();
            $divsionResult = Location::where('Location_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(5)
                ->get();
            $subdivsionResult = SubLocation::where('subLocation_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(5)
                ->get();
            $categoryResult = Category::where('category_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(5)
                ->get();
            $subcategoryResult = SubCategory::where('subCategory_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(5)
                ->get();

            $data = [$divsionResult, $subdivsionResult, $categoryResult, $subcategoryResult, $itemResult];
        } else {
            $data = [];
        }

        return json_encode($data);
    }
}
