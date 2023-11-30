@extends('layout')
@section('main')
<div class="container px-2 my-2">


    {{-- Display errors --}}
    @if($errors->any())
        <div class="alert alert-danger" style="display:flex; justify-content:center">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" id="createCaseCard" action="{{ route('createcasecard') }}">
    @csrf
    @method('PUT')
        
    <div style="padding-bottom: 10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        
        <input type="text" name="user" value="user" style="display: none">
        <div class="row" style="display: flex; justify-content:space-between;">

            <div class="col">
                <label for="title">Nation ID# &nbsp;</label>
                <input type="text" maxlength="11" name="PatientNID">
            </div>

            <div class="col">
                <label for="title">Registration Number &nbsp;</label>
                <input type="text" name="RegistrationNumber" required>
            </div>

            <div class="col" style="text-align: end">
            <label for="title">Clinic # &nbsp;</label>
                <select name="ClinicNo" style="width:250px">
                    
                    @foreach ($clinics as $clinic)
                    {{-- Changes selected option to the corresponding Serial--}}
                    <option value="{{ $clinic->FacilityID }}">{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                    @endforeach

                </select>
            
            </div>

        </div>
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">

            <div class="col">
                <label for="title">Passport # &nbsp;</label>
                <input type="text" maxlength="10"name="PatientPassportNo">
            </div>

            <div class="col">
                <label for="title">Former Registration #</label>
                <input type="text"name="FormerRegistrationNumber">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Name of S.R.H.S Clinic Previously Attended &nbsp;</label>
                <select name="FormerClinicNumber"  >
                    <option value=""></option>
                    {{-- Should I keep it as facility name or switch to facility code --}}
                    @foreach ($clinics as $clinic)
                    <option value="{{ $clinic->FacilityName }}">{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                    @endforeach
                    
                </select>
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Date of Visit &nbsp;</label>
                <input type="date" name="CaseCardDate" required>
            </div>

            <div class="col">
                <label for="title">First Name &nbsp;</label>
                <input type="text" name="FirstName" required>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Last Name &nbsp;</label>
                <input type="text" name="LastName" required>
            </div>

        </div>
    </div>

    <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
    <h5>Address & Contact Information</h5>
        <div class="row" style="display: flex; justify-content:space-between;">
            
            <div class="col">
                <label for="title">Street Name &nbsp;</label>
                <input type="text" name="StreetName">
            </div>

            <div class="col"><h4 style="font-size: 1rem;text-align: end">Change of Address:</h4></div>

            <div class="col" style="text-align: end">
                <label for="title">Street Name &nbsp;</label>
                <input type="text" name="ChStreetName">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">City Name &nbsp;</label>
                <input type="text" name="CityName">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">City Name &nbsp;</label>
                <input type="text" name="ChCityName">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Country &nbsp;</label>
                <select name="Country" >
                            
                    @foreach ($countries as $country)
                    {{-- Changes selected option to the corresponding Serial--}}
                    <option value="{{ $country->CountryName }}" {{$country->CountryName  == 'TRINIDAD AND TOBAGO' ? 'selected' : ''}}>{{ $country->CountryName }}</option>
                    @endforeach

                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Telephone &nbsp;</label>
                <input type="text" name="TelephoneContact">
            </div>

        </div>
    </div>

    <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        <h5>Patient Information</h5>
        <div class="row" style="display: flex; justify-content:space-between;">
            
            <div class="col">
                <label for="title">Date of Birth &nbsp;</label>
                <input type="date" name="DateOfBirth">
            </div>

            <div class="col">
                <label for="title">Age at Case Card Date &nbsp;</label>
                <input type="number" name="Age">
            </div>


            <div class="col" style="text-align: end">
                <label for="title">Current Age &nbsp;</label>
                <input type="number" value="" style="width: 100px">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Gender &nbsp;</label>
            
                <select name="Gender" >
                            
                    @foreach ($sexes as $sex)
                        {{-- Changes selected option to the corresponding Serial--}}
                        <option value="{{ $sex->SexCode }}">{{ $sex->Description }}</option>
                    @endforeach

                
                </select>
            </div>

            <div class="col">
                <label for="title">Ethnic Group &nbsp;</label>

                <select name="EthicGroup" >
                    
                    @foreach ($ethnicities as $ethnicity)
                    {{-- Changes selected option to the corresponding Serial--}}
                    <option value="{{ $ethnicity->Code }}">{{ $ethnicity->Decent }}</option>
                    @endforeach

                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Religion &nbsp;</label>

                <select name="Religion" >
                            
                    @foreach ($religions as $religion)
                        <option value="{{ $religion->RegCode }}">{{ $religion->RegName }}</option>
                    @endforeach

                </select>
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Highest Level of Education Attainment &nbsp;</label>

                <select name="EduAttainment" >
                            
                    @foreach ($edulevels as $edulevel)
                        <option value="{{ $edulevel->EduCode }}">{{ $edulevel->Level }}</option>
                    @endforeach

                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Union Status &nbsp;</label>

                <select name="UniStatus" style="width: 60%">

                    @foreach ($unionstatuses as $unionstatus)
                        <option value="{{ $unionstatus->UnionCode }}">{{ $unionstatus->UnionStatus }}</option>
                    @endforeach

                </select>
            </div>

        </div>
        
        <div style="display: flex;margin-top:10px">
            
            <label for="title">Employment Status &nbsp;</label>

            <select name="EmpStatus" >
                        
                @foreach ($employeestatuses as $employeestatus)
                    <option value="{{ $employeestatus->EmployCode }}">{{ $employeestatus->EmployStatus }}</option>
                @endforeach

            </select>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Household Income Occurence &nbsp;</label>
                
                <select name="HouseHoldIncomeOcc" >
                    
                    @foreach ($houseincoccs as $houseincocc)
                        <option value="{{ $houseincocc->HouseHoldIncomeOcc }}">{{ $houseincocc->HouseHoldIncomeOcc }}</option>
                    @endforeach
                            
                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Household Income Range &nbsp;</label>
                
                <select name="HouseHoldIncomeRange" >
                            
                    @foreach ($houseincranges as $houseincrange)
                            <option value="{{ $houseincrange->IncomeRateCode }}">{{ $houseincrange->IncomeRate }}</option>
                    @endforeach
                    
                </select>
            </div>

        </div>
        
        <div style="display: flex;margin-top:10px">
            
            <label for="title">What influenced you to attend this clinic &nbsp;</label>

            <select name="ClinicInfluence" >

                @foreach ($clinicinfluences as $clinicinfluence)
                    <option value="{{ $clinicinfluence->Referee }}">{{ $clinicinfluence->Referee }}</option>
                @endforeach

            </select>

        </div>
    </div>
    <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        <h5>TO BE COMPLETED BY CLINIC NURSE OR DOCTOR</h5>

        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Total number of pregnancies &nbsp;</label>
                <input type="number" style="width: 100px" name="NumPregnancies">
            </div>

            <div class="col">
                <label for="title">Total number of live births &nbsp;</label>
                <input type="number" style="width: 100px" name="NumLiveBirths">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Total number of children alive &nbsp;</label>
                <input type="number" style="width: 100px" name="NumChildAlive">
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Year of last pregnancy &nbsp;</label>
                <input type="text" style="width: 100px" name="YrLastPregnacy" pattern="[0-9]*" title="Please enter numbers only">
            </div>

            <div class="col">
                <label for="title">Gestation weeks &nbsp;</label>
                <input type="text" style="width: 100px" name="GestWeeks" pattern="[0-9]*" title="Please enter numbers only">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Outcome of last pregnancy &nbsp;</label>
                
            <select name="OutLastPrenancy" >

                <option value=""></option>
                @foreach ($pregnancyoutcomes as $pregnancyoutcome)
                    <option value="{{ $pregnancyoutcome->LastPregCode }}">{{ $pregnancyoutcome->LastPregStatus }}</option>
                @endforeach

            </select>
            </div>

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Intend to have more children &nbsp;</label>
    
                <select name="ChildMore" >
                            
                    @foreach ($yesno as $yesno)
                            <option value="{{ $yesno->YesNoCode }}">{{ $yesno->YesNoValue }}</option>
                    @endforeach
    
                    
                </select>
            </div>

            <div class="col">
                <label for="title">How many more children &nbsp;</label>
                <input type="text" name="ChildHave">
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Infertility Case &nbsp;</label>
    
                <select name="InfertCase">
                            
                    @foreach ($infertilityYesNo as $yesno)
                            <option value="{{ $yesno->YesNoCode }}">{{ $yesno->YesNoValue }}</option>
                    @endforeach
    
                    
                </select>
            </div>

        </div>
        
        <div style="display: flex;margin-top:10px">
            
            <label for="title">Name of contraceptive method used before &nbsp;</label>
            <input type="text" name="NameContra">

        </div>
        
        <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
            <div class="col">
                <label for="title">Previously used contraceptive method &nbsp;</label>
    
                
                <select name="ContraceptionUsed" >
                    
                    <option value=""></option>        
                    @foreach ($contraceptives as $contraceptive)
                            <option value="{{ $contraceptive->ContraceptiveTypeID }}">{{ $contraceptive->ContraceptiveTypeID }} {{ $contraceptive->ContraceptiveType }}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Contraception Type &nbsp;</label>
                {{-- In the database there are values like 11. There is no 11 code in the contraceptive type table --}}
                <select name="ContraceptionType" id="ContraceptionType">
    
                    <option value=""></option>    
                    @foreach ($contraceptives as $contraceptive)
                                <option value="{{ $contraceptive->ContraceptiveTypeID }}">{{ $contraceptive->ContraceptiveTypeID }} {{ $contraceptive->ContraceptiveType }}</option>
                    @endforeach
    
                </select>
            </div>
        </div>
    </div>

    <table style="display: flex;justify-content: center;align-items:">
        <tr>
            <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
            <td><br><a class="btn btn-danger btn-lg px-4 me-sm-3" href="{{ route('casecardsearch') }}">Cancel</a></td>
        </tr>
    </table> 
</form>

    
</div>
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
</script>
    
@endsection