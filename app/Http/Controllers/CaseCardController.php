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
use App\Rules\PatientRegNo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CaseCardController extends Controller
{
    public function index()
    {
        return view('casecardsearch');
    }

    public function getCaseCards()
    {
        $query = Patient::select('PatCliNumber', 'RegistrationNumber', 'FirstName', 'LastName', 'ClinicNo', 'facility.FacilityName as FacilityName')
            ->join('facility', 'patient.ClinicNo', '=', 'facility.FacilityID');
        // return datatables($query)->make(true);
        return DataTables::of($query)->make(true);

        // return DataTables::of($query)->toJson();
    }

    public function edit($id)
    {
        $currentage = NULL;
        $patient = Patient::find($id);

        if ($patient->DateOfBirth !== null || $patient->DateOfBirth !== '') {
            $dob = Carbon::parse($patient->DateOfBirth);
            $now = Carbon::now();
            $currentage = $dob->diffInYears($now);
        }

        if ($patient) {

            $formattedDOB = Carbon::parse($patient->DateOfBirth)->format('Y-m-d');
            $patient->formatted_DOB = $formattedDOB;

            $formattedCaseCardDate = Carbon::parse($patient->CaseCardDate)->format('Y-m-d');
            $patient->formattedCaseCardDate = $formattedCaseCardDate;
        }

        $patientid = $id;
        $clinics = Facility::all();
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
        $yesno = YesNo::all();
        $infertilityYesNo = YesNo::all();

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
            'currentage'
        );

        if ($patient) {
            return view('casecardedit', $combined);
        }
    }

    public function new()
    {

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
        $infertilityYesNo = YesNo::all();

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
            'contraceptives'
        );

        return view('newcasecard', $combined);
    }

    public function update(Request $request, $id)
    {
        $now = Carbon::now();
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
            'YrLastPregnancy' => $request->input('YrLastPregnacy'),
            'GestWeeks' => $request->input('GestWeeks'),
            'OutLastPregnancy' => $request->input('OutLastPrenancy'),
            'ChildMore' => $request->input('ChildMore'),
            'ChildHave' => $request->input('ChildHave'),
            'ChildHaveNodata' => $request->input('ChildHaveNodata'),
            'InfertCase' => $request->input('InfertCase'),
            'ContraBefore' => $request->input('ContraBefore'),
            'NameContra' => $request->input('NameContra'),
            'ContraceptionUsed' => $request->input('ContraceptionUsed'),
            'ContraceptionType' => $request->input('ContraceptionType'),
            'DateModified' => $now,
            'ModifiedBy' => $request->input('useredit'),

        ]);

        return redirect()->route('casecardsearch')->with('success', 'Record edited successfully.');
    }

    public function createCaseCard(Request $request)
    {

        $now = Carbon::now();
        $now = $now->format('Y-m-d H:i:s');

        $request->validate([
            'RegistrationNumber' => [
                'required',
                new PatientRegNo($request->input('ClinicNo'))
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
            'YrLastPregnancy' => $request->input('YrLastPregnacy'),
            'GestWeeks' => $request->input('GestWeeks'),
            'OutLastPregnancy' => $request->input('OutLastPrenancy'),
            'ChildMore' => $request->input('ChildMore'),
            'ChildHave' => $request->input('ChildHave'),
            'ChildHaveNodata' => $request->input('ChildHaveNodata'),
            'InfertCase' => $request->input('InfertCase'),
            'ContraBefore' => $request->input('ContraBefore'),
            'NameContra' => $request->input('NameContra'),
            'ContraceptionUsed' => $request->input('ContraceptionUsed'),
            'ContraceptionType' => $request->input('ContraceptionType'),
            'DateCreated' => $now,
            'CreatedBy' => $request->input('user'),
            'DateModified' => $now,
            'ModifiedBy' => $request->input('user'),
        ]);

        return redirect()->route('casecardsearch')->with('success', 'Case card entered successfully.');
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        PatientVisit::where('PatCliNumber', $id)->delete();

        $patient->delete();

        return redirect()->route('casecardsearch')->with('success', 'Case Card deleted successfully.');
        // return redirect()->route('casecardsearch');
    }

    public function successRedirect()
    {
        return redirect()->route('casecardsearch')->with('success', 'Case Card deleted successfully.');
    }
}
