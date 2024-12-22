<?php

namespace App\Http\Controllers;
use App\Models\Confirmation;
use PDF;

use Illuminate\Http\Request;

class ConfirmationPDFController extends Controller
{
    public function download($id)

    {
        $data = Confirmation::find($id); // Assuming you're passing the ID of the person
        $pdf = Pdf::loadView('pdf.confirmation', compact('data'));
        return $pdf->download('confirmation.pdf');
    }
}
