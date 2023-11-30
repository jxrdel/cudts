<?php

namespace App\Http\Controllers;

use App\Models\CaseType;
use App\Models\DailyRegister;
use App\Models\DoneReferred;
use App\Models\Facility;
use App\Models\IUCDExp;
use App\Models\IUCDInsert;
use App\Models\Papsmear;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\PregnancyTest;
use App\Models\ProstateReport;
use App\Models\SeenBy;
use App\Models\Test;
use App\Models\YesNo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyRegisterController extends Controller
{
    public function index()
    {
        $clinics = Facility::orderBy('FacilityName', 'asc')->get();
        $variables = compact('clinics');
        return view('dailyregistersearch', $variables);
    }

    public function getDailyRegisters()
    {
        $query = DailyRegister::select('dailyregister.DailyRegisterID as DailyRegisterID', 'dailyregister.Date as RegisterDate', 'dailyregister.FacilityID as FacilityID', 'facility.FacilityName as FacilityName')
            ->join('facility', 'dailyregister.FacilityID', '=', 'facility.FacilityID');
        return datatables($query)->editColumn('RegisterDate', function ($record) {
            return Carbon::parse($record->RegisterDate)->format('d/m/Y'); // Change the format as needed
        })->make(true);
    }

    public function new($id, $drid)
    {
        $dailyregister = DailyRegister::find($drid);
        $patient = Patient::find($id);
        $clinic = Facility::all();
        $yesno = YesNo::all();
        $seenby = SeenBy::all();
        $casetype = CaseType::all();
        $iucdinsert = IUCDInsert::all();
        $iucdexp = IUCDExp::all();
        $test = Test::all();
        $prostatetest = Test::all();
        $papsmear = Papsmear::all();
        $prostatereport = ProstateReport::all();
        $tldonereferred = DoneReferred::all();
        $vasdonereferred = DoneReferred::all();
        $pregnancytest = PregnancyTest::all();

        $variables = compact('dailyregister', 'patient', 'yesno', 'seenby', 'iucdinsert', 'iucdexp', 'test', 'prostatetest', 'papsmear', 'prostatereport', 'tldonereferred', 'vasdonereferred', 'pregnancytest', 'clinic', 'casetype');

        return view('newdailyregister', $variables);
    }

    public function createDailyRegister(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d');

        $newRecord = DailyRegister::create([
            'Date' => $request->input('Date'),
            'FacilityID' => $request->input('FacilityID'),
            'DateCreated' => $now,
            'CreatedBy' => $request->input('user'),
            'DateModified' => $now,
            'ModifiedBy' => $request->input('user'),
        ]);

        return redirect()->route('dailyregistersearch')->with('success', 'Daily register created successfully.');
    }

    public function edit($id)
    {
        $dailyregister = DailyRegister::find($id);

        $formattedDate = Carbon::parse($dailyregister->Date)->format('Y-m-d');
        $dailyregister->formattedDate = $formattedDate;

        $clinics = Facility::all();
        return view('editdailyregister', compact('dailyregister', 'clinics'));
    }

    public function update(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d');

        DailyRegister::where('DailyRegisterID', $request->input('DailyRegisterID'))->update([
            'Date' => $request->input('Date'),
            'FacilityID' => $request->input('FacilityID'),
            'DateModified' => $now,
            'ModifiedBy' => $request->input('user'),
        ]);

        return redirect()->route('dailyregistersearch')->with('success', 'Daily register edited successfully.');
    }
}
