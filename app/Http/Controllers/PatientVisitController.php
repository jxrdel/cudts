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

class PatientVisitController extends Controller
{
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

        $variables = compact('drid', 'dailyregister', 'patient', 'yesno', 'seenby', 'iucdinsert', 'iucdexp', 'test', 'prostatetest', 'papsmear', 'prostatereport', 'tldonereferred', 'vasdonereferred', 'pregnancytest', 'clinic', 'casetype');

        return view('newpatientvisit', $variables);
    }

    public function view($dailyregisterid)
    {
        $records = PatientVisit::where('DailyRegisterID', $dailyregisterid)
            ->join('patient', 'patientvisits.PatCliNumber', '=', 'patient.PatCliNumber')
            ->select('patientvisits.*', 'patient.FirstName as FirstName', 'patient.LastName as LastName', 'patient.RegistrationNumber as RegistrationNumber')
            ->get();
        // dd($records);
        return view('viewpatientvisits', ['records' => $records], ['dailyregisterid' => $dailyregisterid]);
    }

    public function createPatientVisit(Request $request, $dailyregisterid)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d H:i:s');

        PatientVisit::create([
            'DailyRegisterID' => $dailyregisterid,
            'PatCliNumber' => $request->input('PatCliNumber'),
            'CaseType' => $request->input('CaseType'),
            'SeenBy' => $request->input('SeenBy'),
            'IUCDIns' => $request->input('IUCDIns'),
            'IUCDExp' => $request->input('IUCDExp'),
            'TL' => $request->input('TL'),
            'Vasectomy' => $request->input('Vasectomy'),
            'PapSmearTest' => $request->input('PapSmearTest'),
            'PapSmearReport' => $request->input('PapSmearReport'),
            'ProstateTest' => $request->input('ProstateTest'),
            'ProstateReport' => $request->input('ProstateReport'),
            'PregnancyTest' => $request->input('PregnancyTest'),
            'CondomQuantity' => $request->input('CondomQuantity'),
            'FoamTabQuantity' => $request->input('FoamTabQuantity'),
            'PillQuantity' => $request->input('PillQuantity'),
            'InjectionQuantity' => $request->input('InjectionQuantity'),
            'IUCDQuantity' => $request->input('IUCDQuantity'),
            'Counselling' => $request->input('Counselling'),
            'Other' => $request->input('Other'),
            'TransferType' => $request->input('TransferType'),
            'DateCreated' => $now,
            'CreatedBy' => $request->input('user'),
            'DateModified' => $now,
            'ModifiedBy' => $request->input('user'),

        ]);
        return redirect()->route('viewpatientvisits', ['id' => $dailyregisterid])->with('success', 'Record entered successfully.');
    }

    public function edit($id)
    {

        $patientvisit = PatientVisit::find($id);
        $patient = Patient::find($patientvisit->PatCliNumber);
        $dailyregister = DailyRegister::find($patientvisit->DailyRegisterID);
        $formattedDate = Carbon::parse($dailyregister->Date)->format('Y-m-d');
        $dailyregister->formattedDate = $formattedDate;

        if (!$patientvisit) {
            return "Record not found";
        }

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

        $variables = compact('patient', 'dailyregister', 'patientvisit', 'yesno', 'seenby', 'iucdinsert', 'iucdexp', 'test', 'prostatetest', 'papsmear', 'prostatereport', 'tldonereferred', 'vasdonereferred', 'pregnancytest', 'clinic', 'casetype');

        return view('editpatientvisit', $variables);
    }

    public function update(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d H:i:s');

        PatientVisit::where('PatientVisitID', $request->input('PatientVisitID'))->update([
            'CaseType' => $request->input('CaseType'),
            'SeenBy' => $request->input('SeenBy'),
            'IUCDIns' => $request->input('IUCDIns'),
            'IUCDExp' => $request->input('IUCDExp'),
            'TL' => $request->input('TL'),
            'Vasectomy' => $request->input('Vasectomy'),
            'PapSmearTest' => $request->input('PapSmearTest'),
            'PapSmearReport' => $request->input('PapSmearReport'),
            'ProstateTest' => $request->input('ProstateTest'),
            'ProstateReport' => $request->input('ProstateReport'),
            'PregnancyTest' => $request->input('PregnancyTest'),
            'CondomQuantity' => $request->input('CondomQuantity'),
            'FoamTabQuantity' => $request->input('FoamTabQuantity'),
            'PillQuantity' => $request->input('PillQuantity'),
            'InjectionQuantity' => $request->input('InjectionQuantity'),
            'IUCDQuantity' => $request->input('IUCDQuantity'),
            'Counselling' => $request->input('Counselling'),
            'Other' => $request->input('Other'),
            'TransferType' => $request->input('TransferType'),
            'DateModified' => $now,
            'ModifiedBy' => $request->input('user'),
        ]);

        return redirect()->route('viewpatientvisits', ['id' => $request->input('DailyRegisterID')])->with('success', 'Record updated successfully.');
    }

    public function destroy($id, $drid)
    {
        $patientvisit = PatientVisit::find($id);

        $patientvisit->delete();

        return redirect()->route('viewpatientvisits', ['id' => $drid])->with('success', 'Patient visit deleted successfully.');
        // return redirect()->route('casecardsearch');
    }
}
