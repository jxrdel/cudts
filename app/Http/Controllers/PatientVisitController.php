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
use Illuminate\Support\Facades\Auth;

class PatientVisitController extends Controller
{
	//New patient visit page
    public function new($id, $drid)
    {
		//Retrieval of values for dropdown
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

		//Compacting all variables
        $variables = compact('drid', 'dailyregister', 'patient', 'yesno', 'seenby', 'iucdinsert', 'iucdexp', 'test', 'prostatetest', 'papsmear', 'prostatereport', 'tldonereferred', 'vasdonereferred', 'pregnancytest', 'clinic', 'casetype');

        return view('newpatientvisit', $variables);
    }

	//Page to view records for a specific daily register
    public function view($dailyregisterid)
    {
		//Get patient visit records for corresponding Daily Register
        $records = PatientVisit::where('DailyRegisterID', $dailyregisterid)
            ->join('patient', 'patientvisits.PatCliNumber', '=', 'patient.PatCliNumber')
            ->select('patientvisits.*', 'patient.FirstName as FirstName', 'patient.LastName as LastName', 'patient.RegistrationNumber as RegistrationNumber')
            ->get();
		
		//Different method to parse variables to view
        return view('viewpatientvisits', ['records' => $records], ['dailyregisterid' => $dailyregisterid]);
    }

	//Insert new patient visit into database
    public function createPatientVisit(Request $request, $dailyregisterid)
    {
		//Get current time
        $now = Carbon::now('AST');
        $now = $now->format('Y-m-d H:i:s');

		//Create new record
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
            'CreatedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),
            'DateModified' => $now,
            'ModifiedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),

        ]);
		
		//Redirect with success message
        return redirect()->route('viewpatientvisits', ['id' => $dailyregisterid])->with('success', 'Record entered successfully.');
    }

	//Page to edit patient visit
    public function edit($id)
    {

        $patientvisit = PatientVisit::find($id);
        $patient = Patient::find($patientvisit->PatCliNumber);
        $dailyregister = DailyRegister::find($patientvisit->DailyRegisterID);
		
		//Format date so that is is compatible with default date picker
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

	//Update of edited record
    public function update(Request $request)
    {
        $now = Carbon::now('AST');
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
            'ModifiedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),
        ]);

        return redirect()->route('viewpatientvisits', ['id' => $request->input('DailyRegisterID')])->with('success', 'Record updated successfully.');
    }
	
	//Delete patient visit
    public function destroy($id, $drid)
    {
        $patientvisit = PatientVisit::find($id);

        $patientvisit->delete();

        return redirect()->route('viewpatientvisits', ['id' => $drid])->with('success', 'Patient visit deleted successfully.');
        // return redirect()->route('casecardsearch');
    }
}
