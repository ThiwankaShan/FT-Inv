<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\Location;
use App\SubLocation;
use App\Category;
use App\SubCategory;
use App\Supplier;
use App\Items;

use Illuminate\Pagination\Paginator;

class reportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $locations = Location::all();
        $subLocations = SubLocation::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $suppliers = Supplier::all();
        return view('pages.reports', compact('locations', 'categories','subCategories','subLocations','suppliers'));
    }

    public function pdfDownload()
    {   // genrate a pdf from filterd item details

        //getting items from filter session
        $items = session('items_download');
        $subLocation_code = session('sub_location');
        $start = session('start');
        $end = session('end');
        if ($subLocation_code!=null){
            $department = SubLocation::where('subLocation_code', $subLocation_code)->get('subLocation_name')[0]['subLocation_name'];
            $department = 'Department : '.$department;
        }else{
            $department = '';
        }
        
        $grandTotal = 0;
        foreach ($items as $item){
            $grandTotal = $grandTotal + $item['rate'];
        }

        //This is for testing purposes
        //return view('reports.template',compact('items','grandTotal'));

        $pdf = PDF::loadView('reports.template',compact('items','grandTotal','department','start','end'));
        return $pdf->download('report.pdf');

    }
}
