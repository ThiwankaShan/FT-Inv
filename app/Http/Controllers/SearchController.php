<?php

namespace App\Http\Controllers;

use App\Category;
use App\Division;
use App\Items;
use App\SubCategory;
use App\SubDivision;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        error_log($request->get('searchQuerry'));
        if ($request->get('searchQuerry') != null) {
            $itemResult = Items::where('item_code', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('item_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('division_id', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('subdivision_id', 'like', '%' . $request->get('searchQuerry') . '%')
                ->orwhere('category_id', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(10)
                ->get();
            $divsionResult = Division::where('division_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(10)
                ->get();
            $subdivsionResult = SubDivision::where('subDivision_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(10)
                ->get();
            $categoryResult = Category::where('category_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(10)
                ->get();
            $subcategoryResult = SubCategory::where('subCategory_name', 'like', '%' . $request->get('searchQuerry') . '%')
                ->take(10)
                ->get();

            $data = [$divsionResult, $subdivsionResult, $categoryResult, $subcategoryResult, $itemResult];
        } else {
            $data = [];
        }

        return json_encode($data);
    }
}
