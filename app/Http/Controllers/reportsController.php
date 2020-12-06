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
        return view('reports.template',compact('items'));

        $pdf = PDF::loadView('reports.template',compact('items'));
        return $pdf->download('report.pdf');

    }
}
