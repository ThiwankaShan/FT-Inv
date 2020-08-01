<?php

namespace App\Http\Controllers;

use App\Category;
use App\Division;
use App\Items;
use App\SubCategory;
use App\SubDivision;
use Illuminate\Http\Request;
use Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $divsionResult = Division::where('division_name', 'like', '%' . $request->get('value') . '%')
            ->pluck('division_id');
        $subdivsionResult = SubDivision::where('subDivision_name', 'like', '%' . $request->get('value') . '%')
            ->pluck('subdivision_id');
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
            ->orwhere('division_id', isempty($divsionResult))
            ->orwhere('subdivision_id', isempty($subdivsionResult))
            ->orwhere('category_id', isempty($categoryResult))
            ->orwhere('subCategory_id', isempty($subcategoryResult))
            ->get();

        Session::put('key', $itemResult);
        return redirect()->route('home');
    }
}
