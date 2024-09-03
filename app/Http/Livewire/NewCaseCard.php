<?php

namespace App\Http\Livewire;

use App\Models\ClinicInfluence;
use App\Models\ContraceptiveType;
use App\Models\Country;
use App\Models\EduLevel;
use App\Models\EmpStatus;
use App\Models\Ethnicity;
use App\Models\Facility;
use App\Models\HouseIncOcc;
use App\Models\HouseIncRange;
use App\Models\Patient;
use App\Models\PregnancyOutcome;
use App\Models\Religion;
use App\Models\Sex;
use App\Models\UnionStatus;
use App\Models\YesNo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Rules\ValidateRegNo;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Livewire\Features\SupportEvents\HandlesEvents;

class NewCaseCard extends Component
{
    public $user;
    public $PatientNID;
    public $RegistrationNumber;
    public $ClinicNo = 16932;
    public $PatientPassportNo;
    public $FormerRegistrationNumber;
    public $FormerClinicNumber;
    public $CaseCardDate;
    public $FirstName;
    public $LastName;

    public $StreetName;
    public $ChStreetName;
    public $CityName;
    public $ChCityName;
    public $Country = 'TRINIDAD AND TOBAGO';
    public $TelephoneContact;

    public $DateOfBirth;
    public $Age;
    public $Gender;
    public $EthicGroup = 5;
    public $Religion = 8;
    public $EduAttainment = 5;
    public $UniStatus = 6;
    public $EmpStatus = 7;
    public $HouseHoldIncomeOcc = 'Monthly';
    public $HouseHoldIncomeRange = 6;
    public $ClinicInfluence = '9 Not Stated';

    public $NumPregnancies;
    public $NumLiveBirths;
    public $NumChildAlive;
    public $YrLastPregnancy;
    public $GestWeeks;
    public $OutLastPregnancy;
    public $ChildMore = 3;
    public $ChildHave;
    public $InfertCase = 3;
    public $ContraBefore;
    public $ContraceptionUsed;
    public $ContraceptionType;

    public $clinics;
    public $countries;
    public $sexes;
    public $ethnicities;
    public $religions;
    public $edulevels;
    public $unionstatuses;
    public $employeestatuses;
    public $houseincoccs;
    public $houseincranges;
    public $clinicinfluences;
    public $pregnancyoutcomes;
    public $contraceptives;
    public $yesno;
    public $contraYesNo;
    public $infertilityYesNo;

    public function mount(Request $request)
    {
		$this->user = "MOH\\". strtolower(Auth::user()->samaccountname[0]);
        $this->clinics = Facility::orderBy('FacilityName', 'asc')->get();
        $this->countries = Country::all();
        $this->sexes = Sex::all();
        $this->ethnicities = Ethnicity::all();
        $this->religions = Religion::all();
        $this->edulevels = EduLevel::all();
        $this->unionstatuses = UnionStatus::all();
        $this->employeestatuses = EmpStatus::all();
        $this->houseincranges = HouseIncRange::all();
        $this->clinicinfluences = ClinicInfluence::all();
        $this->pregnancyoutcomes = PregnancyOutcome::all();
        $this->contraceptives = ContraceptiveType::all();
        $this->yesno = YesNo::all();
        $this->contraYesNo = YesNo::all();
        $this->infertilityYesNo = YesNo::all();
    }
    public function render()
    {
        return view('livewire.new-case-card');
    }

    public function validateCaseCard()
    {try {
          //dd($this->ClinicNo);
        // $validator = $this->validate([
        //     'RegistrationNumber' => ['required', new PatientRegNo($this->ClinicNo)],
        // ]);

        $validator = Validator::make([
            'RegistrationNumber' => $this->RegistrationNumber,
            // Other input fields...
        ], [
            'RegistrationNumber' => ['required', new ValidateRegNo($this->ClinicNo)],
            // Other validation rules...
        ]);


        // Check if validation passed
        if ($validator->fails()) {
            //dd($this->user);
            $this->dispatchBrowserEvent('display-modal');
        } else {
            // Validation passed, create ase card
            $this->createCaseCard();
        }
        } catch (Exception $e) {
            dd($e);
        }
        
    }

    public function createCaseCard()
    {
        $now = Carbon::now('AST');
        $now = $now->format('Y-m-d H:i:s');


        Patient::create([
            'RegistrationNumber' => $this->RegistrationNumber,
            'ClinicNo' => $this->ClinicNo,
            'CaseCardDate' => $this->CaseCardDate,
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'PatientNID' => $this->PatientNID,
            'PatientPassportNo' => $this->PatientPassportNo,
            'FormerRegistrationNumber' => $this->FormerRegistrationNumber,
            'FormerClinicNumber' => $this->FormerClinicNumber,
            'Gender' => $this->Gender,
            'Age' => $this->Age,
            'StreetName' => $this->StreetName,
            'CityName' => $this->CityName,
            'Country' => $this->Country,
            'ChStreetName' => $this->ChStreetName,
            'ChCityName' => $this->ChCityName,
            'TelephoneContact' => $this->TelephoneContact,
            'DateOfBirth' => $this->DateOfBirth,
            'EthicGroup' => $this->EthicGroup,
            'Religion' => $this->Religion,
            'EduAttainment' => $this->EduAttainment,
            'UniStatus' => $this->UniStatus,
            'EmpStatus' => $this->EmpStatus,
            'HouseHoldIncomeOcc' => $this->HouseHoldIncomeOcc,
            'HouseHoldIncomeRange' => $this->HouseHoldIncomeRange,
            'ClinicInfluence' => $this->ClinicInfluence,
            'NumPregnancies' => $this->NumPregnancies,
            'NumLiveBirths' => $this->NumLiveBirths,
            'NumChildAlive' => $this->NumChildAlive,
            'YrLastPregnancy' => $this->YrLastPregnancy,
            'GestWeeks' => $this->GestWeeks,
            'OutLastPregnancy' => $this->OutLastPregnancy,
            'ChildMore' => $this->ChildMore,
            'ChildHave' => $this->ChildHave,
            'InfertCase' => $this->InfertCase,
            'ContraBefore' => $this->ContraBefore,
            'ContraceptionUsed' => $this->ContraceptionUsed,
            'ContraceptionType' => $this->ContraceptionType,
            'DateCreated' => $now,
            'CreatedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),
            'DateModified' => $now,
            'ModifiedBy' => "MOH\\". strtolower(Auth::user()->samaccountname[0]),
        ]);

        return redirect()->route('casecardsearch')->with('success', 'Case card entered successfully.');
    }
}
