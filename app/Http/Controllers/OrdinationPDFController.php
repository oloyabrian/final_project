<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordination;
use PDF;

class OrdinationPDFController extends Controller
{
    public function download($id)

{
    $data = Ordination::find($id); // Assuming you're passing the ID of the person
    $pdf = Pdf::loadView('pdf.ordination', compact('data'));
    return $pdf->download('ordination.pdf');
}
}
