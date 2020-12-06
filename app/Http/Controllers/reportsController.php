<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class reportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pdfReport()
    {   // genrate a pdf from filterd item details

        //getting items from filter session
        $items = session('items_download');
        $grandTotal = 0;
        foreach ($items as $item){
            $grandTotal = $grandTotal + $item['rate'];

        }

        //This is for testing purposes
        //return view('reports.template',compact('items','grandTotal'));

        $pdf = PDF::loadView('reports.template',compact('items','grandTotal'));
        return $pdf->download('report.pdf');

    }
}
