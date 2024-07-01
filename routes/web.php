<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Datareceiver;
use App\Http\Controllers\ProfileController;

use App\Models\Datareceiverattandances;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->get('/', [Datareceiver::class, 'index'])->name('home');



Route::prefix('admin')->group(function () {
    Route::get('/loginForm', [AdminController::class, 'login'])->name('login_form');
    Route::post('/loginSubmit', [AdminController::class, 'loginSubmit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}', [AdminController::class, 'reset_password_form'])->name('admin_password_reset');
    Route::post('/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
});



Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/getData', [Datareceiver::class, 'getDataFromApi'])->name('admin_getDataFromApi');
    Route::get('/addData', [Datareceiver::class, 'storeDataFromApi'])->name('admin_addData');
    Route::get('/dashboard', [Datareceiver::class, 'fetchdatafromattandances'])->name('admin_dashboard');
    Route::get('/getattandancebyday/{searchDate?}', [Datareceiver::class, 'fetchdatafromattandancesbyday'])->name('admin.search_by_date');
    Route::post('/register-attendance/{searchDate?}', [Datareceiver::class, 'registerAttendance'])->name('admin.register_attendance');

    Route::get('/search-attendance-results', [Datareceiver::class, 'searchAttendanceByDateResult'])->name('admin.search_result_by_date');
    Route::get('/attendance/{id}/edit', [Datareceiver::class, 'editAttandanceState'])->name('attendance.edit');
    Route::put('/attendance/{id}/update', [Datareceiver::class, 'updateAttandanceStateSubmit'])->name('attendance.update');
    // Route::get('/pdf/{filename}', [Datareceiver::class, 'show'])->name('pdf.show');
    Route::get('/document/{id}', [Datareceiver::class, 'showDocument'])->name('document.show');
    Route::get('/teacher-rapport', [Datareceiver::class, 'showTeacherRapport'])->name('admin.teacherRapport');
    Route::post('/attendance/report', [Datareceiver::class, 'generateAttendanceReport'])->name('attendance.report');
    Route::get('/month-rapport', [Datareceiver::class, 'showMonthRapport'])->name('admin.monthRapportView');
    Route::post('/monthAttendance/report', [Datareceiver::class, 'generateAttendanceReportAllTeachersMonth'])->name('attendanceMonth.report');
    Route::get('/monthAttendance/report/view', [Datareceiver::class, 'viewAttendanceReportAllTeachersMonth'])->name('admin.monthAttendanceReportView');
    Route::get('/teacherAttendance/report/lastview', [Datareceiver::class, 'viewAttendanceReportTeacherlastResult'])->name('admin.teacherLastResultAttendanceReportView');
    Route::get('/teacherAttendance/report/pdf', [Datareceiver::class, 'downloadTeacherReportPdf'])->name('downloadteacherRepport.pdf');
    Route::get('/monthAttendance/report/pdf', [Datareceiver::class, 'downloadMonthReportPdf'])->name('downloadMonthRepport.pdf');
});




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
