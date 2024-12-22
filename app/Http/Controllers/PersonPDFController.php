<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use PDF;

class PersonPDFController extends Controller
{
    public function download(){
        $persons = Person::all();
        $data =[            
            'date'=>date('d/m/y'),
            'persons'=>$persons
        ];
        $pdf = PDF::loadView('personPDF', $data);
        return $pdf->download('sms_developer_oloya.pdf');
    }
}
