<?php

namespace App\Http\Controllers;

use App\Category;
use App\Location;
use App\Items;
use App\SubCategory;
use App\SubLocation;
use Illuminate\Http\Request;
use Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $divsionResult = Location::where('Location_name', 'like', '%' . $request->get('value') . '%')
            ->pluck('Location_id');
        $subdivsionResult = SubLocation::where('subLocation_name', 'like', '%' . $request->get('value') . '%')
            ->pluck('subLocation_id');
        $categoryResult = Category::where('category_name', 'like', '%' . $request->get('value') . '%')
            ->pluck('category_id');
        $subcategoryResult = SubCategory::where('subCategory_name', 'like', '%' . $request->get('value') . '%')
            ->pluck('subCategory_id');

        function isempty($result)
        {
            if ($result->isEmpty()) {
                $result = '';
            }
            return $result;
        }

        $itemResult = Items::where('item_code', 'like', '%' . $request->get('value') . '%')
            ->orwhere('Location_id', isempty($divsionResult))
            ->orwhere('subLocation_id', isempty($subdivsionResult))
            ->orwhere('category_id', isempty($categoryResult))
            ->orwhere('subCategory_id', isempty($subcategoryResult))
            ->get();

        Session::put('key', $itemResult);
        return redirect()->route('home');
    }
}
