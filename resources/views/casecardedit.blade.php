@extends('layout')
@section('main')
<div class="container">

    @if ($patient)
		<div class="modal fade modal-sm" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="deleteModalLabel" style="color:red;margin:auto">Warning <i class="bi bi-exclamation-triangle"></i></h1>
            </div>
            <div class="modal-body">
              {{-- Form to create daily register --}}
                <form method="POST" id="createDailyRegister" action="#">
                    @csrf
                    @method('PUT')
                    <div class="mb-3" style="text-align:center">
                      <p>Are you sure you want to delete the case card for <strong>{{$patient->FirstName}} {{$patient->LastName}}</strong>. <br></p>
                      <p>All patient visits associated with this patient will be permanently deleted</p>
                    </div>
                    <div class="row" style="display: flex">
                        <div class="col">
                            <a href="{{ route('deletecasecard', ['id' => $patientid]) }}" class="btn btn-danger" style="margin:auto">Delete</a>
                        </div>
    
                        <div class="col" style="text-align: end">
                            <a href="#"><button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" style="margin:auto; width:90px">Cancel</button></a>
                        </div>
    
                    </div>
                  </form>
            </div>
          </div>
        </div>
        </div>

    <form method="POST" id="updatecasecard" action="{{ route('updatecasecard', ['id' => $patientid]) }}">
        @csrf
        @method('PUT')
        
    
    
    <input type="text" name="user" value="{{$_SERVER['AUTH_USER']}}" style="display: none">
    <div style="padding-bottom: 10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">

        <div class="row" style="display: flex; justify-content:space-between;">

            <div class="col">
                <label for="title">Nation ID# &nbsp;</label>
                <input type="text" name="PatientNID" value="{{$patient->PatientNID}}" maxlength="11">
            </div>

            <div class="col">
                <label for="title">Registration Number &nbsp;</label>
                <input type="text" name="RegistrationNumber" value="{{$patient->RegistrationNumber}}" required>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Clinic # &nbsp;</label>
                <select name="ClinicNo" style="width:250px">
                            
                    {{-- Stores Clinic # in a variable to determine selected option in the dropdown --}}
                    @php
                        $selectedClinicNo = $patient->ClinicNo;
                    @endphp
    
                    @foreach ($clinics as $clinic)
                    {{-- Changes selected option to the corresponding Clinic--}}
                    <option value="{{ $clinic->FacilityID }}" {{ $selectedClinicNo == $clinic->FacilityID ? 'selected' : '' }}>{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                    @endforeach
                </select>
            </div>
            

        </div>
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">

            <div class="col">
                <label for="title">Passport # &nbsp;</label>
                <input type="text" name="PatientPassportNo" value="{{$patient->PatientPassportNo}}" maxlength="10">
            </div>

            <div class="col">
                <label for="title">Former Registration #</label>
                <input type="text" name="FormerRegistrationNumber" value="{{$patient->FormerRegistrationNumber}}">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Name of S.R.H.S Clinic Previously Attended &nbsp;</label>
                <select name="FormerClinicNumber" >
                    @if ($patient->FormerClinicNumber > 0)
                        @php
                            //Store current value of FormerClinicNumber
                            $selectedFormerClinic = $patient->FormerClinicNumber;
                        @endphp
    
                        @foreach ($clinics as $clinic)
                            {{-- Changes selected option to the corresponding FormerClinicNumber--}}
                            <option value="{{ $clinic->FacilityName }}" {{ $selectedFormerClinic == $clinic->FacilityName ? 'selected' : '' }}>{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                        @endforeach
                        
                    @else
                        <option value="{{$patient->FormerClinicNumber}}"></option>
                        @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->FacilityName }}">{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                        @endforeach
                    @endif
                            
                    
                </select>
            </div>
            

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Date of Visit &nbsp;</label>
                <input type="date" id="CaseCardDate" name="CaseCardDate" value="{{$patient->formattedCaseCardDate}}">
            </div>

            <div class="col">
                <label for="title">First Name &nbsp;</label>
                <input type="text" name="FirstName" value="{{$patient->FirstName}}">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Last Name &nbsp;</label>
                <input type="text" name="LastName" value="{{$patient->LastName}}">
            </div>

        </div>
    </div>

    <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        <h5>Address & Contact Information</h5>
        <div style="display: flex; justify-content:space-between;">
            
            <div class="col">
                <label for="title">Street Name &nbsp;</label>
                <input type="text" name="StreetName" value="{{$patient->StreetName}}">
            </div>

            <div class="col"><h4 style="font-size: 1rem;text-align: end">Change of Address:</h4></div>

            <div class="col" style="text-align: end">
                <label for="title">Street Name &nbsp;</label>
                <input type="text" name="ChStreetName" value="{{$patient->ChStreetName}}">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">City Name &nbsp;</label>
                <input type="text" name="CityName" value="{{$patient->CityName}}">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">City Name &nbsp;</label>
                <input type="text" name="ChCityName" value="{{$patient->ChCityName}}">
            </div>

        </div>
        
        <div style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col"><label for="title">Country &nbsp;</label>
                <select name="Country" >
                            
                    @php
                        $selectedCountry = $patient->Country;
                    @endphp
    
                    @if ($selectedCountry == 'TRINIDAD & TOBAGO' || $selectedCountry == 'TRINIDAD' || $selectedCountry == 'Tobago' || $selectedCountry == 'Trinidad And Tobago')
                        @foreach ($countries as $country)
                        <option value="{{ $country->CountryName }}" {{ $country->CountryName == 'TRINIDAD AND TOBAGO' ? 'selected' : '' }}>{{ $country->CountryName }}</option>
                        @endforeach
                    @else
                        @foreach ($countries as $country)
                        <option value="{{ $country->CountryName }}" {{ $selectedCountry == $country->CountryName ? 'selected' : '' }}>{{ $country->CountryName }}</option>
                        @endforeach
                    @endif
    
                    
                </select>
            </div>
            
            <div class="col" style="text-align: end">
                <label for="title">Telephone &nbsp;</label>
                <input type="text" name="TelephoneContact" value="{{$patient->TelephoneContact}}">
            </div>

        </div>
    </div>

    <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        <h5>Patient Information</h5>
        <div class="row" style="display: flex; justify-content:space-between;">
            
            <div class="col">
                <label for="title">Date of Birth &nbsp;</label>
                <input type="date" id="DateOfBirth" name="DateOfBirth" value="{{$patient->formatted_DOB}}">
            </div>

            <div class="col">
                <label for="title">Age at Case Card Date &nbsp;</label>
                <input type="text" id="Age" name="Age" value="{{$patient->Age}}" style="width:100px">
                <button onclick="calculateDateDifference()">Update Age</button>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Current Age &nbsp;</label>
                <input type="text" value="{{$currentage}}" style="width: 100px">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col"><label for="title">Gender &nbsp;</label>
            
                <select name="Gender" >
                            
                    @php
                        $selectedSex = $patient->Gender;
                    @endphp
    
                    @if (is_null($selectedSex))
                    <option value=""></option>
                    @foreach ($sexes as $sex)
                        <option value="{{ $sex->SexCode }}" {{ $selectedSex == $sex->SexCode ? 'selected' : '' }}>{{ $sex->Description }}</option>
                    @endforeach
                    
                    @else
                        @foreach ($sexes as $sex)
                        <option value="{{ $sex->SexCode }}" {{ $selectedSex == $sex->SexCode ? 'selected' : '' }}>{{ $sex->Description }}</option>
                        @endforeach
                    @endif
    
                
                </select>
            </div>
            
            <div class="col">
                <label for="title">Ethnic Group &nbsp;</label>

                <select name="EthicGroup" >
                            
                    @php
                        $selectedEthicGroup = $patient->EthicGroup;
                    @endphp
    
                    @foreach ($ethnicities as $ethnicity)
                    <option value="{{ $ethnicity->Code }}" {{ $selectedEthicGroup == $ethnicity->Code ? 'selected' : '' }}>{{ $ethnicity->Decent }}</option>
                    @endforeach
                </select>
            </div>
            

            <div class="col" style="text-align: end">
                <label for="title">Religion &nbsp;</label>
    
                <select name="Religion" >
                            
                    @php
                        $selectedReligion = $patient->Religion;
                    @endphp
                    @if (is_null($selectedReligion))
                        
                        @foreach ($religions as $religion)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                        <option value="{{ $religion->RegCode }}" {{ $religion->RegName  == '9 Not Stated' ? 'selected' : '' }}>{{ $religion->RegName }}</option>
                        @endforeach
    
                    @else
    
                        @foreach ($religions as $religion)
                            <option value="{{ $religion->RegCode }}" {{ $selectedReligion == $religion->RegCode ? 'selected' : '' }}>{{ $religion->RegName }}</option>
                        @endforeach
    
                    @endif
                </select>
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Highest Level of Education Attainment &nbsp;</label>
    
                <select name="EduAttainment" >
                            
                    @php
                        $selectedEduAttainment = $patient->EduAttainment;
                    @endphp
                    @if (is_null($selectedEduAttainment))
                        
                        @foreach ($edulevels as $edulevel)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                        <option value="{{ $edulevel->EduCode }}" {{ $edulevel->Level  == '9 Not Stated' ? 'selected' : '' }}>{{ $edulevel->Level }}</option>
                        @endforeach
    
                    @else
    
                        @foreach ($edulevels as $edulevel)
                            <option value="{{ $edulevel->EduCode }}" {{ $selectedEduAttainment == $edulevel->EduCode ? 'selected' : '' }}>{{ $edulevel->Level }}</option>
                        @endforeach
    
                    @endif
                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Union Status &nbsp;</label>
    
                <select name="UniStatus" >
                            
                    @php
                        $selectedUniStatus = $patient->UniStatus;
                    @endphp
                    @if (is_null($selectedUniStatus))
                        
                        @foreach ($unionstatuses as $unionstatus)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                        <option value="{{ $unionstatus->UnionCode }}" {{ $unionstatus->UnionStatus  == '9 Not stated' ? 'selected' : '' }}>{{ $unionstatus->UnionStatus }}</option>
                        @endforeach
    
                    @else
    
                        @foreach ($unionstatuses as $unionstatus)
                            <option value="{{ $unionstatus->UnionCode }}" {{ $selectedUniStatus == $unionstatus->UnionCode ? 'selected' : '' }}>{{ $unionstatus->UnionStatus }}</option>
                        @endforeach
    
                    @endif
                </select>
            </div>

        </div>
        
        <div style="display: flex;margin-top:10px">
            
            <label for="title">Employment Status &nbsp;</label>

            <select name="EmpStatus" >
                        
                @php
                    $selectedEmpStatus = $patient->EmpStatus;
                @endphp

                @if (is_null($selectedEmpStatus))
                    
                    @foreach ($employeestatuses as $employeestatus)
                    {{-- If value is null, set dropdown value to 'Not Stated' --}}
                    <option value="{{ $employeestatus->EmployCode }}" {{ $employeestatus->EmployStatus  == '9 Not Stated' ? 'selected' : '' }}>{{ $employeestatus->EmployStatus }}</option>
                    @endforeach

                @else

                    @foreach ($employeestatuses as $employeestatus)
                        <option value="{{ $employeestatus->EmployCode }}" {{ $selectedEmpStatus == $employeestatus->EmployCode ? 'selected' : '' }}>{{ $employeestatus->EmployStatus }}</option>
                    @endforeach

                @endif
            </select>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Household Income Occurence &nbsp;</label>
                
                <select name="HouseHoldIncomeOcc" >
                            
                    @php
                        $selectedHouseHoldIncomeOcc = $patient->HouseHoldIncomeOcc;
                    @endphp
    
                    @if ($selectedHouseHoldIncomeOcc == ' ' || $selectedHouseHoldIncomeOcc == '' || is_null($selectedHouseHoldIncomeOcc))
                        
                        <option value=""></option>
                        @foreach ($houseincoccs as $houseincocc)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                        <option value="{{ $houseincocc->HouseHoldIncomeOcc }}">{{ $houseincocc->HouseHoldIncomeOcc }}</option>
                        @endforeach
    
                    @else
                        @if ($selectedHouseHoldIncomeOcc == 'MLY' || $selectedHouseHoldIncomeOcc == 'Monthly')
    
                            @foreach ($houseincoccs as $houseincocc)
                                <option value="{{ $houseincocc->HouseHoldIncomeOcc }}" {{ $houseincocc->HouseHoldIncomeOcc == 'Monthly' ? 'selected' : '' }}>{{ $houseincocc->HouseHoldIncomeOcc }}</option>
                            @endforeach
                            
                        @else
    
                            @foreach ($houseincoccs as $houseincocc)
                                <option value="{{ $houseincocc->HouseHoldIncomeOcc }}" {{ $selectedHouseHoldIncomeOcc == $houseincocc->HouseHoldIncomeOcc ? 'selected' : '' }}>{{ $houseincocc->HouseHoldIncomeOcc }}</option>
                            @endforeach
                            
                        @endif
    
                    @endif
                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Household Income Range &nbsp;</label>
                
                <select name="HouseHoldIncomeRange" >
                            
                    @php
                        $selectedHouseHoldIncomeRange = $patient->HouseHoldIncomeRange;
                    @endphp
    
    
                    @if (is_null($selectedHouseHoldIncomeRange) || $selectedHouseHoldIncomeRange == '9')
                        @foreach ($houseincranges as $houseincrange)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                            <option value="{{ $houseincrange->IncomeRateCode }}" {{ $houseincrange->IncomeRate  == 'Not Stated' ? 'selected' : '' }}>{{ $houseincrange->IncomeRate }}</option>
                        @endforeach
                    @else
                        
                        @foreach ($houseincranges as $houseincrange)
                            <option value="{{ $houseincrange->IncomeRateCode }}" {{ $houseincrange->IncomeRateCode  == $selectedHouseHoldIncomeRange ? 'selected' : '' }}>{{ $houseincrange->IncomeRate }}</option>
                        @endforeach
                    @endif
    
                    
                </select>
            </div>

        </div>
        
        <div style="display: flex;margin-top:10px">
            
            <label for="title">What influenced you to attend this clinic &nbsp;</label>

            <select name="ClinicInfluence">
                        
                @php
                    $selectedClinicInfluence = $patient->ClinicInfluence;
                @endphp
                @if ($patient->ClinicInfluence == 'Self')
                    @foreach ($clinicinfluences as $clinicinfluence)
                    {{-- If value is null, set dropdown value to 'Not Stated' --}}
                    <option value="{{ $clinicinfluence->Referee }}" {{ $clinicinfluence->Referee  == '5 Other' ? 'selected' : '' }}>{{ $clinicinfluence->Referee }}</option>
                    @endforeach
                @endif
                @if (is_null($selectedClinicInfluence))
                    
                    @foreach ($clinicinfluences as $clinicinfluence)
                    {{-- If value is null, set dropdown value to 'Not Stated' --}}
                    <option value="{{ $clinicinfluence->Referee }}" {{ $clinicinfluence->Referee  == '9 Not Stated' ? 'selected' : '' }}>{{ $clinicinfluence->Referee }}</option>
                    @endforeach

                @else

                    @foreach ($clinicinfluences as $clinicinfluence)
                        <option value="{{ $clinicinfluence->Referee }}" {{ strpos($clinicinfluence->Referee, $selectedClinicInfluence) !== false ? 'selected' : '' }}>{{ $clinicinfluence->Referee }}</option>
                    @endforeach

                @endif
            </select>

        </div>
    </div>
        
    <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        <h5>TO BE COMPLETED BY CLINIC NURSE OR DOCTOR</h5>
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Total number of pregnancies &nbsp;</label>
                <input type="text" name="NumPregnancies" value="{{$patient->NumPregnancies}}" style="width: 100px">
            </div>

            <div class="col">
                <label for="title">Total number of live births &nbsp;</label>
                <input type="text" name="NumLiveBirths" value="{{$patient->NumLiveBirths}}" style="width: 100px">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Total number of children alive &nbsp;</label>
                <input type="text" name="NumChildAlive" value="{{$patient->NumChildAlive}}" style="width: 100px">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Year of last pregnancy &nbsp;</label>
                <input type="text" name="YrLastPregnancy" value="{{$patient->YrLastPregnancy}}" style="width: 100px">
            </div>

            <div class="col">
                <label for="title">Gestation weeks &nbsp;</label>
                <input type="text" name="GestWeeks" value="{{$patient->GestWeeks}}" style="width: 100px">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Outcome of last pregnancy &nbsp;</label>
                <select name="OutLastPregnancy" >
                    @php
                        $selectedOutLastPrenancy = $patient->OutLastPrenancy;
                    @endphp

                    <option value=""></option>
                    @foreach ($pregnancyoutcomes as $pregnancyoutcome)
                        <option value="{{ $pregnancyoutcome->LastPregCode }}" {{ strpos($pregnancyoutcome->LastPregStatus, $selectedOutLastPrenancy) !== false ? 'selected' : '' }}>{{ $pregnancyoutcome->LastPregStatus }}</option>
                    @endforeach
    
                </select>
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Intend to have more children &nbsp;</label>
    
                
                <select name="ChildMore" >
                            
                    @php
                        $selectedChildMore = $patient->ChildMore;
                    @endphp
    
    
                    @if (is_null($selectedChildMore) || $selectedChildMore == '9')
                        @foreach ($yesno as $yesno)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                            <option value="{{ $yesno->YesNoCode }}" {{ $yesno->YesNoValue  == '9 Not Stated' ? 'selected' : '' }}>{{ $yesno->YesNoValue }}</option>
                        @endforeach
                    @else
                        
                        @foreach ($yesno as $yesno)
                            <option value="{{ $yesno->YesNoCode }}" {{ $yesno->YesNoCode  == $selectedChildMore ? 'selected' : '' }}>{{ $yesno->YesNoValue }}</option>
                        @endforeach
                    @endif
    
                    
                </select>
            </div>

            <div class="col">
                <label for="title">How many more children &nbsp;</label>
                <input type="text" name="ChildHave" value="{{$patient->ChildHave}}">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Infertility Case &nbsp;</label>
    
                <select name="InfertCase">
                            
                    @php
                        $selectedInfertCase = $patient->InfertCase;
                    @endphp
    
    
                    @if (is_null($selectedInfertCase) || $selectedInfertCase == '9' || $selectedInfertCase == '9 Not Stated' || $selectedInfertCase == '3')
                        @foreach ($infertilityYesNo as $yesno)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                            <option value="{{ $yesno->YesNoCode }}" {{ $yesno->YesNoValue  == '9 Not Stated' ? 'selected' : '' }}>{{ $yesno->YesNoValue }}</option>
                        @endforeach
                    @else
                        @if ($selectedInfertCase == 'No')
                            @foreach ($infertilityYesNo as $yesno)
                            {{-- If value is null, set dropdown value to 'Not Stated' --}}
                                <option value="{{ $yesno->YesNoCode }}" {{ $yesno->YesNoValue  == '2 No' ? 'selected' : '' }}>{{ $yesno->YesNoValue }}</option>
                            @endforeach
                        @else
                            @foreach ($infertilityYesNo as $yesno)
                            <option value="{{ $yesno->YesNoCode }}" {{ strpos($yesno->YesNoValue, $selectedInfertCase) !== false ? 'selected' : '' }}  >{{ $yesno->YesNoValue }}</option>
                            @endforeach
                        @endif
                        
                        
                    @endif
    
                    
                </select>
            </div>
            

        </div>
        
        <div style="display: flex;margin-top:10px">
            
            <label for="title">Name of contraceptive method used before &nbsp;</label>
            <input type="text" name="NameContra" value="{{$patient->NameContra}}">

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Previously used contraceptive method &nbsp;</label>
    
                
                <select name="ContraceptionUsed" >
                            
                    @php
                        $selectedContraceptionUsed = $patient->ContraceptionUsed;
                    @endphp
    
    
                     @foreach ($contraYesNo as $yesno)
                            <option value="{{ $yesno->YesNoCode }}" {{ strpos($yesno->YesNoValue, $selectedContraceptionUsed) !== false ? 'selected' : '' }}  >{{ $yesno->YesNoValue }}</option>
                            @endforeach
    
                    
                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Contraception Type &nbsp;</label>

                
                <select name="ContraceptionType" >
                            
                    @php
                        $selectedContraceptionType = $patient->ContraceptionType;
                    @endphp
    
                    @if (is_null($selectedContraceptionType) || $selectedContraceptionType == '11' || $selectedContraceptionType == '0')
                        @foreach ($contraceptivetypes as $contraceptivetype)
                        {{-- If value is null, set dropdown value to 'Not Stated' --}}
                            <option value="{{ $contraceptivetype->ContraceptiveTypeID }}" {{ $contraceptivetype->ContraceptiveType  == 'None' ? 'selected' : '' }}>{{ $contraceptivetype->ContraceptiveTypeID }} {{ $contraceptivetype->ContraceptiveType }}</option>
                        @endforeach
                    @else
                        
                        @foreach ($contraceptivetypes as $contraceptivetype)
                            <option value="{{ $contraceptivetype->ContraceptiveTypeID }}" {{ strpos($selectedContraceptionType, $contraceptivetype->ContraceptiveTypeID) !== false ? 'selected' : '' }}  >{{ $contraceptivetype->ContraceptiveTypeID }} {{ $contraceptivetype->ContraceptiveType }}</option>
                        @endforeach
                    @endif
    
                    
                </select>
            </div>

        </div>
    </div>

    @endif
    <table style="display: flex;justify-content: center;align-items:">
        <tr>
            <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit" style="width: 150px">Save</button></td>
            <td><br><a class="btn btn-success btn-lg px-4 me-sm-3" href="{{ route('casecardsearch') }}" style="width: 150px">Cancel</a></td>
            <td><br><a class="btn btn-danger btn-lg px-4 me-sm-3" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" style="width: 150px">Delete <i class="bi bi-trash3"></i></a></td>
        </tr>
    </table> 
</form>

    
</div>
<br>
@endsection

@section('scripts')
    <script>
        document.getElementById("updatecasecard").addEventListener("submit", function(event) 
                {
                    event.preventDefault(); // Prevent the form from submitting by default
                    
                    // Get the values of the start date and end date fields
                    const CaseCardDate = new Date(document.getElementById("CaseCardDate").value);
                    const DateOfBirth = new Date(document.getElementById("DateOfBirth").value);

                    if (!isDateValid(CaseCardDate)){
                        // Checks Date of Visit
                    alert("Please check date of visit");
                    } else if (!isDateValid(DateOfBirth)){
                        // Checks DOB
                    alert("Please check date of discharge");
                    }else {
                    // Submit once everything is validated
                    this.submit();

                    
                }
                
                });

        function isDateValid(inputDate) {
            // Create a Max and minimum dates
            const mindate = new Date(1900, 0, 1); // Months are zero-based (0 = January)
            const maxdate = new Date(9999, 0, 1); // Months are zero-based (0 = January)

            // Create a Date object from the input date string
            const inputDateObject = new Date(inputDate);

            
            return (mindate < inputDateObject) && (inputDateObject < maxdate);
        }

        function calculateDateDifference() {
            event.preventDefault();
            const startDateInput = document.getElementById("DateOfBirth");
            const endDateInput = document.getElementById("CaseCardDate");
            const resultElement = document.getElementById("Age");

            if (endDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                const yearDifference = endDate.getFullYear() - startDate.getFullYear();

                resultElement.value = yearDifference;
            } else {
                alert("Date of Birth or Date of Visit is empty");
            }
        }
    </script>
@endsection