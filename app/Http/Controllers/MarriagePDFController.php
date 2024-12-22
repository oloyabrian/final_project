<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marriage;
use PDF;

class MarriagePDFController extends Controller
{
    public function download($id)

    {
        $data = Marriage::find($id); // Assuming you're passing the ID of the person
        $pdf = Pdf::loadView('pdf.marriage', compact('data'));
        return $pdf->download('marriage.pdf');
    }
}
