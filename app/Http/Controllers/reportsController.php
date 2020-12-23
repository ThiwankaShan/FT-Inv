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
use App\Grn;
use Log;

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

    public function preview(Request $request){
        
        $data = $request->all();
        if ($data['purchased_start']!=NULL and $data['purchased_end']!=NULL ){
            $data += ['purchased_date'=>[$data['purchased_start'],$data['purchased_end']]] ;
        }

        if ($data['period_start']!=NULL and $data['period_end']!=NULL ){
            $data += ['created_at'=>[$data['period_start'],$data['period_end']]] ;
        }

        if ($data['supplier']!=NULL ){
            $supplier = $data['supplier'];
            $data += ['GRN_number'=> Grn::where('supplier_code','=',$data['supplier'])->get('GRN_number') ] ;
        }
        
        
        $data = array_diff_key($data, array_flip(['_token','purchased_start','purchased_end','period_start','period_end','supplier']));
        
        $items = Items::whereNested(function($query) use ($data) {
            foreach ($data as $key => $value)
                {
                    if($key == 'purchased_date'){
                        $query->whereBetween($key, $value);
                    }

                    else if($key == 'created_at'){
                        $query->whereBetween($key, $value);
                    }

                    else if($key == 'GRN_number'){
                        $query->whereIn($key, $value);
                    }

                    else if($value != ''){
                        $query->where($key, '=', $value);
                    }
                }
        }, 'and')->orderBy('item_code', 'ASC')->get();

        if ($data['subLocation_code']!=NULL ){
            $data += ['unit' =>SubLocation::find($data['subLocation_code'])->subLocation_name];
        }

        if ($data['location_code']!=NULL ){
            $data += ['department' =>Location::find($data['location_code'])->location_name];
        }

        if (isset($supplier) ){
            $data += ['supplier' =>Supplier::find($supplier)->supplier_name];
        }
        
        return view('tables.report_table',compact('items','data'));

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
