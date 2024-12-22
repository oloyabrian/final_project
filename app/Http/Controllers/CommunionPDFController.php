<?php

namespace App\Http\Controllers;
use App\Models\Communion;
use PDF;

use Illuminate\Http\Request;

class CommunionPDFController extends Controller
{
        public function download($id)
    
        {
            $data = Communion::find($id); // Assuming you're passing the ID of the person
            $pdf = Pdf::loadView('pdf.communion', compact('data'));
            return $pdf->download('communion.pdf');
        }
    
}
