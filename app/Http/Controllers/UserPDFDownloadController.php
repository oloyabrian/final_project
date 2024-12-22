<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserPDFDownloadController extends Controller
{
    public function download($id)

{
    $data = Person::find($id); // Assuming you're passing the ID of the person
    $pdf = Pdf::loadView('pdf.user', ['data' => $data]);
    return $pdf->download('user.pdf');
} 
}
