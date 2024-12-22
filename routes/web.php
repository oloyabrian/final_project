<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\PersonPDFController;
use App\Http\Controllers\MarriagePDFController;
use App\Http\Controllers\OrdinationPDFController;
use App\Http\Controllers\PesrsonPDFDownloadController; 
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ConfirmationPDFController; 
use App\Http\Controllers\CommunionPDFController;
use App\Http\Controllers\BaptismPDFController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/app/email/verify', [VerificationController::class, 'show'])->name('filament.app.auth.email-verification.notice');
    Route::get('/app/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('filament.app.auth.email-verification.verify');
    Route::post('/app/email/resend', [VerificationController::class, 'resend'])->name('filament.app.auth.email-verification.resend');
});
//pdf download
Route::get('/pdf/download/{record}', [PesrsonPDFDownloadController::class, 'download'])->name('person.pdf');

Route::get('person.pdf/{record}', [PesrsonPDFDownloadController::class, 'download'])->name('person.pdf');

Route::get('ordination.pdf/{record}', [OrdinationPDFController::class, 'download'])->name('ordination.pdf');

Route::get('marriage.pdf/{record}', [MarriagePDFController::class, 'download'])->name('marriage.pdf');

Route::get('confirmation.pdf/{record}', [ConfirmationPDFController::class, 'download'])->name('confirmation.pdf');

Route::get('communion.pdf/{record}', [CommunionPDFController::class, 'download'])->name('communion.pdf');

Route::get('baptism.pdf/{record}', [BaptismPDFController::class, 'download'])->name('baptism.pdf');





// Use DownloadController for other downloads as well

Route::get('/download/baptism-pdf', [DownloadController::class, 'downloadBaptismPDF'])->name('download.baptism.pdf');
Route::get('/download/person-pdf', [DownloadController::class, 'downloadPersonPDF'])->name('download.person.pdf');
Route::get('/download/ordination-pdf', [DownloadController::class, 'downloadOrdinationPDF'])->name('download.ordination.pdf');
Route::get('/download/baptism-pdf', [DownloadController::class, 'downloadBaptismPDF'])->name('download.baptism.pdf');
Route::get('/download/communion-pdf', [DownloadController::class, 'downloadCommunionPDF'])->name('download.communion.pdf');
Route::get('/download/confirmation-pdf', [DownloadController::class, 'downloadConfirmationPDF'])->name('download.confirmation.pdf');
Route::get('/download/marriage-pdf', [DownloadController::class, 'downloadMarriagePDF'])->name('download.marriage.pdf');
Route::get('/download/user-pdf', [DownloadController::class, 'downloadUserPDF'])->name('download.user.pdf');

///Route::get('/download/person-pdf/{id}', [DownloadController::class, 'downloadPersonPDF'])->name('download.person.pdf');

