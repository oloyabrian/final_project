<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



//use PDF;
use App\Models\Person;
use App\Models\Baptism;
use App\Models\Communion;
use App\Models\Confirmation;
use App\Models\Marriage;
use App\Models\User;
use App\Models\Ordination; 
use Carbon\Carbon; 


class DownloadController extends Controller
{
    public function downloadPersonPDF()
    {
        // Fetch all persons data
        $data = Person::all();
        $date = Carbon::now()->format('Y-m-d');
        // Pass data to the view with an associative array
        $pdf = Pdf::loadView('person1PDF', compact('data', 'date'));

        // Download the generated PDF
        return $pdf->download('person.pdf');
    }

    public function downloadBaptismPDF()
    {
        $baptisms = Baptism::all();
        $date = Carbon::now()->format('Y-m-d');
        $pdf = PDF::loadView('baptismPDF', compact('baptisms', 'date'));
        return $pdf->download('baptisms.pdf');
    }

    public function downloadCommunionPDF()
    {
        $communions = Communion::all();
        $date = Carbon::now()->format('Y-m-d');
        $pdf = PDF::loadView('communionPDF', compact('communions', 'date'));
        return $pdf->download('communions.pdf');
    }

    public function downloadConfirmationPDF()
    {
        $confirmations = Confirmation::all();
        $date = Carbon::now()->format('Y-m-d');
        $pdf = PDF::loadView('confirmationPDF', compact('confirmations', 'date'));
        return $pdf->download('confirmations.pdf');
    }

    public function downloadMarriagePDF()
    {
        $marriages = Marriage::all();
        $date = Carbon::now()->format('Y-m-d');
        $pdf = PDF::loadView('marriagePDF', compact('marriages', 'date'));

        return $pdf->download('marriages.pdf');
    }

    public function downloadOrdinationPDF()
    {
        $ordinations = Ordination::all();
        $date = Carbon::now()->format('Y-m-d');
        $pdf = PDF::loadView('ordinationPDF', compact('ordinations', 'date'));

        return $pdf->download('ordinations.pdf');
    }
    public function downloadUserPDF()
    {
        $users = User::all();
        $date = Carbon::now()->format('Y-m-d');
        $pdf = PDF::loadView('userPDF', compact('users', 'date'));
        return $pdf->download('users.pdf');
    }
}

