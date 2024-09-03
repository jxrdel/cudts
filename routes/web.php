<?php

use App\Http\Controllers\CaseCard;
use App\Http\Controllers\CaseCardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CUDTSController;
use App\Http\Controllers\DailyRegisterController;
use App\Http\Controllers\PatientVisitController;
use App\Http\Controllers\ReportsController;
use App\Models\PatientVisit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [Controller::class, 'login'])->name('login');
Route::get('/logout', [Controller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [Controller::class, 'index'])->name('/');
    Route::get('/casecardsearch', [CaseCardController::class, 'index'])->name('casecardsearch');
    Route::get('/getcasecards', [CaseCardController::class, 'getCaseCards'])->name('getcasecards');
    Route::get('/casecardedit/{id}', [CaseCardController::class, 'edit'])->name('casecardedit');
    Route::get('/newcasecard', [CaseCardController::class, 'new'])->name('newcasecard');
    Route::put('/createcasecard', [CaseCardController::class, 'createCaseCard'])->name('createcasecard');
    Route::put('/updatecasecard/{id}', [CaseCardController::class, 'update'])->name('updatecasecard');
    Route::get('/deletecasecard/{id}', [CaseCardController::class, 'destroy'])->name('deletecasecard');

    Route::get('/dailyregistersearch', [DailyRegisterController::class, 'index'])->name('dailyregistersearch');
    Route::get('/getdailyregisters', [DailyRegisterController::class, 'getDailyRegisters'])->name('getdailyregisters');
    Route::put('/createdailyregister', [DailyRegisterController::class, 'createDailyRegister'])->name('createdailyregister');
    Route::get('/editdailyregister/{id}', [DailyRegisterController::class, 'edit'])->name('editdailyregister');
    Route::put('/updatedailyregister', [DailyRegisterController::class, 'update'])->name('updatedailyregister');

    Route::get('/newpatientvisit/{id}/{drid}', [PatientVisitController::class, 'new'])->name('newpatientvisit');
    Route::get('/viewpatientvisits/{id}', [PatientVisitController::class, 'view'])->name('viewpatientvisits');
    Route::get('/editpatientvisit/{id}', [PatientVisitController::class, 'edit'])->name('editpatientvisit');
    Route::put('/createpatientvisit/{id}', [PatientVisitController::class, 'createPatientVisit'])->name('createpatientvisit');
    Route::put('/updatepatientvisit', [PatientVisitController::class, 'update'])->name('updatepatientvisit');
    Route::get('/deletepatientvisit/{id}/{drid}', [PatientVisitController::class, 'destroy'])->name('deletepatientvisit');

    Route::get('/viewdailyusage/{date}', [ReportsController::class, 'viewDailyUsage'])->name('viewdailyusage');
    Route::get('/viewrangeusage/{startdate}/{enddate}', [ReportsController::class, 'viewRangeUsage'])->name('viewrangeusage');
});