<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;

use App\Models\ClinicInfluence;
use App\Models\ContraceptiveType;
use App\Models\Country;
use App\Models\EduLevel;
use App\Models\EmpStatus;
use App\Models\Ethnicity;
use App\Models\Facility;
use App\Models\HouseIncOcc;
use App\Models\HouseIncRange;
use App\Models\Sex;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\PregnancyOutcome;
use App\Models\Religion;
use App\Models\UnionStatus;
use App\Models\YesNo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rules\ValidateRegNo;
use Illuminate\Support\Facades\Auth;

class CaseCardController extends Controller
{
	//Launch case card search page
    public function index()
    {
        return view('casecardsearch');
    }

	//Populate datatable
    public function getCaseCards()
    {
        $query = Patient::select('PatCliNumber', 'RegistrationNumber', 'FirstName', 'LastName', 'ClinicNo', 'facility.FacilityName as FacilityName')
            ->join('facility', 'patient.ClinicNo', '=', 'facility.FacilityID');
        return datatables($query)->make(true);

    }


	//New case card page
    public function new()
    {
		//Variables for new case card page
        $clinics = Facility::orderBy('FacilityName', 'asc')->get();
        $countries = Country::all();
        $sexes = Sex::all();
        $ethnicities = Ethnicity::all();
        $religions = Religion::all();
        $edulevels = EduLevel::all();
        $unionstatuses = UnionStatus::all();
        $employeestatuses = EmpStatus::all();
        $houseincoccs = HouseIncOcc::all();
        $houseincranges = HouseIncRange::all();
        $clinicinfluences = ClinicInfluence::all();
        $pregnancyoutcomes = PregnancyOutcome::all();
        $contraceptives = ContraceptiveType::all();
        $yesno = YesNo::all();
        $contraYesNo = YesNo::all();
        $infertilityYesNo = YesNo::all();

		//Compacting all variables to send to view
        $combined = compact(
            'clinics',
            'countries',
            'sexes',
            'ethnicities',
            'religions',
            'edulevels',
            'unionstatuses',
            'employeestatuses',
            'houseincoccs',
            'houseincranges',
            'clinicinfluences',
            'pregnancyoutcomes',
            'yesno',
            'infertilityYesNo',
			'contraYesNo',
            'contraceptives'
        );

        return view('newcasecard', $combined);
    }
	
	//Edit case card page
    public function edit($id)
    {
		//Get patient to be edited
        $patient = Patient::find($id);
		
		//Get current age
        $currentage = NULL;

        if ($patient->DateOfBirth !== null || $patient->DateOfBirth !== '') {
            $dob = Carbon::parse($patient->DateOfBirth);
            $now = Carbon::now('AST');
            $currentage = $dob->diffInYears($now);
        }

		//Format dates to be compatible with date picker
        if ($patient) {

            $formattedDOB = Carbon::parse($patient->DateOfBirth)->format('Y-m-d');
            $patient->formatted_DOB = $formattedDOB;

            $formattedCaseCardDate = Carbon::parse($patient->CaseCardDate)->format('Y-m-d');
            $patient->formattedCaseCardDate = $formattedCaseCardDate;
        }

		//Retrieve values for view
        $patientid = $id;
        $clinics = Facility::orderBy('FacilityName', 'asc')->get();
        $countries = Country::all();
        $sexes = Sex::all();
        $ethnicities = Ethnicity::all();
        $religions = Religion::all();
        $edulevels = EduLevel::all();
        $unionstatuses = UnionStatus::all();
        $employeestatuses = EmpStatus::all();
        $houseincoccs = HouseIncOcc::all();
        $houseincranges = HouseIncRange::all();
        $clinicinfluences = ClinicInfluence::all();
        $pregnancyoutcomes = PregnancyOutcome::all();
        $contraceptives = ContraceptiveType::all();
        $contraceptivetypes = ContraceptiveType::all();
        $contraYesNo = YesNo::all();
        $yesno = YesNo::all();
        $infertilityYesNo = YesNo::all();

		//Compact variables for view
        $combined = compact(
            'patientid',
            'patient',
            'clinics',
            'countries',
            'sexes',
            'ethnicities',
            'religions',
            'edulevels',
            'unionstatuses',
            'employeestatuses',
            'houseincoccs',
            'houseincranges',
            'clinicinfluences',
            'pregnancyoutcomes',
            'yesno',
            'infertilityYesNo',
            'contraceptives',
            'contraceptivetypes',
			'contraYesNo',
            'currentage'
        );

		//Redirect to view with variables
        if ($patient) {
            return view('casecardedit', $combined);
        }
    }

	//Update edited case card
    public function update(Request $request, $id)
    {
        $now = Carbon::now('AST');
        $now = $now->format('Y-m-d H:i:s');

        Patient::where('PatCliNumber', $id)->update([
            'RegistrationNumber' => $request->input('RegistrationNumber'),
            'ClinicNo' => $request->input('ClinicNo'),
            'CaseCardDate' => $request->input('CaseCardDate'),
            'FirstName' => $request->input('FirstName'),
            'LastName' => $request->input('LastName'),
            'PatientNID' => $request->input('PatientNID'),
            'PatientDP' => $request->input('PatientDP'),
            'PatientPassportNo' => $request->input('PatientPassportNo'),
            'FormerRegistrationNumber' => $request->input('FormerRegistrationNumber'),
            'FormerClinicNumber' => $request->input('FormerClinicNumber'),
            'Gender' => $request->input('Gender'),
            'Age' => $request->input('Age'),
            'StreetName' => $request->input('StreetName'),
            'CityName' => $request->input('CityName'),
            'Country' => $request->input('Country'),
            'ChStreetName' => $request->input('ChStreetName'),
            'ChCityName' => $request->input('ChCityName'),
            'TelephoneContact' => $request->input('TelephoneContact'),
            'DateOfBirth' => $request->input('DateOfBirth'),
            'EthicGroup' => $request->input('EthicGroup'),
            'Religion' => $request->input('Religion'),
            'EduAttainment' => $request->input('EduAttainment'),
            'UniStatus' => $request->input('UniStatus'),
            'EmpStatus' => $request->input('EmpStatus'),
            'HouseHoldIncomeOcc' => $request->input('HouseHoldIncomeOcc'),
            'HouseHoldIncomeRange' => $request->input('HouseHoldIncomeRange'),
            'ClinicInfluence' => $request->input('ClinicInfluence'),
            'NumPregnancies' => $request->input('NumPregnancies'),
            'NumLiveBirths' => $request->input('NumLiveBirths'),
            'NumChildAlive' => $request->input('NumChildAlive'),
            'YrLastPregnancy' => $request->input('YrLastPregnancy'),
            'GestWeeks' => $request->input('GestWeeks'),
            'OutLastPregnancy' => $request->input('OutLastPregnancy'),
            'ChildMore' => $request->input('ChildMore'),
            'ChildHave' => $request->input('ChildHave'),
            'ChildHaveNodata' => $request->input('ChildHaveNodata'),
            'InfertCase' => $request->input('InfertCase'),
            'ContraBefore' => $request->input('ContraBefore'),
            'NameContra' => $request->input('NameContra'),
            'ContraceptionUsed' => $request->input('ContraceptionUsed'),
            'ContraceptionType' => $request->input('ContraceptionType'),
            'DateModified' => $now,
            'ModifiedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),

        ]);

		//Redirect with success message
        return redirect()->route('casecardsearch')->with('success', 'Record edited successfully.');
    }

	//Create new case card record
    public function createCaseCard(Request $request)
    {

        $now = Carbon::now('AST');
        $now = $now->format('Y-m-d H:i:s');
		
		$request->validate([
            'RegistrationNumber' => [
                'required'
                //new ValidateRegNo($request->input('ClinicNo'))
            ],
        ]);

        Patient::create([
            'RegistrationNumber' => $request->input('RegistrationNumber'),
            'ClinicNo' => $request->input('ClinicNo'),
            'CaseCardDate' => $request->input('CaseCardDate'),
            'FirstName' => $request->input('FirstName'),
            'LastName' => $request->input('LastName'),
            'PatientNID' => $request->input('PatientNID'),
            'PatientDP' => $request->input('PatientDP'),
            'PatientPassportNo' => $request->input('PatientPassportNo'),
            'FormerRegistrationNumber' => $request->input('FormerRegistrationNumber'),
            'FormerClinicNumber' => $request->input('FormerClinicNumber'),
            'Gender' => $request->input('Gender'),
            'Age' => $request->input('Age'),
            'StreetName' => $request->input('StreetName'),
            'CityName' => $request->input('CityName'),
            'Country' => $request->input('Country'),
            'ChStreetName' => $request->input('ChStreetName'),
            'ChCityName' => $request->input('ChCityName'),
            'TelephoneContact' => $request->input('TelephoneContact'),
            'DateOfBirth' => $request->input('DateOfBirth'),
            'EthicGroup' => $request->input('EthicGroup'),
            'Religion' => $request->input('Religion'),
            'EduAttainment' => $request->input('EduAttainment'),
            'UniStatus' => $request->input('UniStatus'),
            'EmpStatus' => $request->input('EmpStatus'),
            'HouseHoldIncomeOcc' => $request->input('HouseHoldIncomeOcc'),
            'HouseHoldIncomeRange' => $request->input('HouseHoldIncomeRange'),
            'ClinicInfluence' => $request->input('ClinicInfluence'),
            'NumPregnancies' => $request->input('NumPregnancies'),
            'NumLiveBirths' => $request->input('NumLiveBirths'),
            'NumChildAlive' => $request->input('NumChildAlive'),
            'YrLastPregnancy' => $request->input('YrLastPregnancy'),
            'GestWeeks' => $request->input('GestWeeks'),
            'OutLastPregnancy' => $request->input('OutLastPregnancy'),
            'ChildMore' => $request->input('ChildMore'),
            'ChildHave' => $request->input('ChildHave'),
            'ChildHaveNodata' => $request->input('ChildHaveNodata'),
            'InfertCase' => $request->input('InfertCase'),
            'ContraBefore' => $request->input('ContraBefore'),
            'NameContra' => $request->input('NameContra'),
            'ContraceptionUsed' => $request->input('ContraceptionUsed'),
            'ContraceptionType' => $request->input('ContraceptionType'),
            'DateCreated' => $now,
            'CreatedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),
            'DateModified' => $now,
            'ModifiedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),
        ]);

        return redirect()->route('casecardsearch')->with('success', 'Case card entered successfully.');
    }
	
	//Delete case card
	public function destroy($id)
    {
        $patient = Patient::find($id);

        $patientvisits = PatientVisit::where('PatCliNumber', $id)->get();

        if($patientvisits){
            PatientVisit::where('PatCliNumber', $id)->delete();
        }

        $patient->delete();

        return redirect()->route('casecardsearch')->with('success', 'Case Card deleted successfully.');
    }
}
