<?php

namespace App\Http\Controllers;
use App\Models\Baptism;
    use PDF;

use Illuminate\Http\Request;

class BaptismPDFController extends Controller
{
      public function download($id)
        
            {
                $data = Baptism::find($id); // Assuming you're passing the ID of the person
                $pdf = Pdf::loadView('pdf.baptism', compact('data'));
                return $pdf->download('baptism.pdf');
            }
}
