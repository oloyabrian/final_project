<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;

class PesrsonPDFDownloadController extends Controller
{
    
    public function download($id)

{
    $data = Person::find($id); // Assuming you're passing the ID of the person
    $pdf = Pdf::loadView('pdf.person', ['data' => $data]);
    return $pdf->download('person.pdf');
}

}
