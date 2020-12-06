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

    public function pdfReport(){

        $items = session('items_download');
        $grandTotal = 0;
        foreach ($items as $item){
            $grandTotal = $grandTotal + $item['rate'];

        }
        //return view('reports.template',compact('items','grandTotal'));

        $pdf = PDF::loadView('reports.template',compact('items','grandTotal'));
        return $pdf->download('report.pdf');

    }
}
