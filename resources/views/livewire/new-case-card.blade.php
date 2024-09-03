<div>
    
    <!-- Modal -->
    <div class="modal fade modal-sm" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="confirmModalLabel" style="color:red;margin:auto">Warning <i class="bi bi-exclamation-triangle"></i></h1>
            </div>
            <div class="modal-body">
                <div class="mb-3" style="text-align:center">
                <p><strong>This Registration Number already exists for this clinic</strong><br></p>
                <p>Press 'Continue' to proceed or 'Cancel' to return to make changes</p>
                </div>
                <div class="row" style="display: flex">
                    <div class="col">
                        <button type="button" wire:click="createCaseCard()" class="btn btn-primary" style="margin:auto">Continue</button>
                    </div>

                    <div class="col" style="text-align: end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" style="margin:auto; width:90px">Cancel</button>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>

    <form wire:submit.prevent="validateCaseCard" id="createCaseCard">
            
        <div style="padding-bottom: 10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
            
            <input type="text" wire:model="user" value="moh\{{ strtolower(auth()->user()->samaccountname[0]) }}" style="display: none">
            <div class="row" style="display: flex; justify-content:space-between;">
    
                <div class="col">
                    <label for="title">Nation ID# &nbsp;</label>
                    <input type="text" maxlength="11" wire:model="PatientNID"  value="moh">
                </div>
    
                <div class="col">
                    <label for="title">Registration Number &nbsp;</label>
                    <input type="text" wire:model="RegistrationNumber">
                </div>
    
                <div class="col" style="text-align: end">
                <label for="title">Clinic # &nbsp;</label>
                    <select wire:model="ClinicNo" style="width:250px">
                        
                        @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->FacilityID }}">{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                        @endforeach
    
                    </select>
                
                </div>
    
            </div>
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
    
                <div class="col">
                    <label for="title">Passport # &nbsp;</label>
                    <input type="text" maxlength="10"wire:model="PatientPassportNo">
                </div>
    
                <div class="col">
                    <label for="title">Former Registration #</label>
                    <input type="text"wire:model="FormerRegistrationNumber">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Name of S.R.H.S Clinic Previously Attended &nbsp;</label>
                    <select wire:model="FormerClinicNumber"  >
                        <option value=""></option>
                        @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->FacilityName }}">{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                        @endforeach
                        
                    </select>
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Date of Visit &nbsp;</label>
                    <input id="CaseCardDate"  type="date" wire:model="CaseCardDate">
                </div>
    
                <div class="col">
                    <label for="title">First Name &nbsp;</label>
                    <input type="text" wire:model="FirstName">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Last Name &nbsp;</label>
                    <input type="text" wire:model="LastName">
                </div>
    
            </div>
        </div>
    
        <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
        <h5>Address & Contact Information</h5>
            <div class="row" style="display: flex; justify-content:space-between;">
                
                <div class="col">
                    <label for="title">Street Name &nbsp;</label>
                    <input type="text" wire:model="StreetName">
                </div>
    
                <div class="col"><h4 style="font-size: 1rem;text-align: end">Change of Address:</h4></div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Street Name &nbsp;</label>
                    <input type="text" wire:model="ChStreetName">
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">City Name &nbsp;</label>
                    <input type="text" wire:model="CityName">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">City Name &nbsp;</label>
                    <input type="text" wire:model="ChCityName">
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Country &nbsp;</label>
                    <select wire:model="Country" >
                                
                        @foreach ($countries as $country)
                        {{-- Changes selected option to the corresponding Country--}}
                        <option value="{{ $country->CountryName }}">{{ $country->CountryName }}</option>
                        @endforeach
    
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Telephone &nbsp;</label>
                    <input type="text" wire:model="TelephoneContact">
                </div>
    
            </div>
        </div>
    
        <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
            <h5>Patient Information</h5>
            <div class="row" style="display: flex; justify-content:space-between;">
                
                <div class="col">
                    <label for="title">Date of Birth &nbsp;</label>
                    <input id="DateOfBirth" type="date" wire:model="DateOfBirth">
                </div>
    
                <div class="col">
                    <label for="title">Age at Case Card Date &nbsp;</label>
                    <input id="Age" type="number" wire:model="Age" style="width:100px">
                    <button onclick="calculateDateDifference()">Update Age</button>
                </div>
    
    
                <div class="col" style="text-align: end">
                    <label for="title">Current Age &nbsp;</label>
                    <input type="number" value="" style="width: 100px">
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Gender &nbsp;</label>
                
                    <select wire:model="Gender" >
                            <option value=""></option>
                        @foreach ($sexes as $sex)
                            {{-- Changes selected option to the corresponding Gender--}}
                            <option value="{{ $sex->SexCode }}">{{ $sex->Description }}</option>
                        @endforeach
    
                    
                    </select>
                </div>
    
                <div class="col">
                    <label for="title">Ethnic Group &nbsp;</label>
    
                    <select wire:model="EthicGroup" >
                        
                        @foreach ($ethnicities as $ethnicity)
                        {{-- Changes selected option to the corresponding Ethnic Group--}}
                        <option value="{{ $ethnicity->Code }}">{{ $ethnicity->Decent }}</option>
                        @endforeach
    
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Religion &nbsp;</label>
    
                    <select wire:model="Religion" >
                                
                        @foreach ($religions as $religion)
                            <option value="{{ $religion->RegCode }}" {{$religion->RegCode  == 8 ? 'selected' : ''}}>{{ $religion->RegName }}</option>
                        @endforeach
    
                    </select>
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Highest Level of Education Attainment &nbsp;</label>
    
                    <select wire:model="EduAttainment" >
                                
                        @foreach ($edulevels as $edulevel)
                            <option value="{{ $edulevel->EduCode }}" {{$edulevel->EduCode  == 5 ? 'selected' : ''}}>{{ $edulevel->Level }}</option>
                        @endforeach
    
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Union Status &nbsp;</label>
    
                    <select wire:model="UniStatus" style="width: 60%">
    
                        @foreach ($unionstatuses as $unionstatus)
                            <option value="{{ $unionstatus->UnionCode }}" {{$unionstatus->UnionCode  == 6 ? 'selected' : ''}}>{{ $unionstatus->UnionStatus }}</option>
                        @endforeach
    
                    </select>
                </div>
    
            </div>
            
            <div style="display: flex;margin-top:10px">
                
                <label for="title">Employment Status &nbsp;</label>
    
                <select wire:model="EmpStatus" >
                            
                    @foreach ($employeestatuses as $employeestatus)
                        <option value="{{ $employeestatus->EmployCode }}" {{$employeestatus->EmployCode  == 7 ? 'selected' : ''}}>{{ $employeestatus->EmployStatus }}</option>
                    @endforeach
    
                </select>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Household Income Occurence &nbsp;</label>
                    
                    <select wire:model="HouseHoldIncomeOcc" >
                        
                        <option value="Monthly">Monthly</option>
                                
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Household Income Range &nbsp;</label>
                    
                    <select wire:model="HouseHoldIncomeRange" >
                                
                        @foreach ($houseincranges as $houseincrange)
                                <option value="{{ $houseincrange->IncomeRateCode }}" {{$houseincrange->IncomeRateCode  == 6 ? 'selected' : ''}}>{{ $houseincrange->IncomeRate }}</option>
                        @endforeach
                        
                    </select>
                </div>
    
            </div>
            
            <div style="display: flex;margin-top:10px">
                
                <label for="title">What influenced you to attend this clinic &nbsp;</label>
    
                <select wire:model="ClinicInfluence" >
    
                    @foreach ($clinicinfluences as $clinicinfluence)
                        <option value="{{ $clinicinfluence->Referee }}" {{$clinicinfluence->Referee  == '9 Not Stated' ? 'selected' : ''}}>{{ $clinicinfluence->Referee }}</option>
                    @endforeach
    
                </select>
    
            </div>
        </div>
        <div style="padding-bottom: 10px; margin-top:10px" class="p-3 text-body-emphasis border border-body-subtle rounded-3">
            <h5>TO BE COMPLETED BY CLINIC NURSE OR DOCTOR</h5>
    
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Total number of pregnancies &nbsp;</label>
                    <input type="number" style="width: 100px" wire:model="NumPregnancies">
                </div>
    
                <div class="col">
                    <label for="title">Total number of live births &nbsp;</label>
                    <input type="number" style="width: 100px" wire:model="NumLiveBirths">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Total number of children alive &nbsp;</label>
                    <input type="number" style="width: 100px" wire:model="NumChildAlive">
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Year of last pregnancy &nbsp;</label>
                    <input type="text" style="width: 100px" wire:model="YrLastPregnancy" pattern="[0-9]*" title="Please enter numbers only">
                </div>
    
                <div class="col">
                    <label for="title">Gestation weeks &nbsp;</label>
                    <input type="text" style="width: 100px" wire:model="GestWeeks" pattern="[0-9]*" title="Please enter numbers only">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Outcome of last pregnancy &nbsp;</label>
                    
                <select wire:model="OutLastPregnancy" >
    
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
        
                    <select wire:model="ChildMore" >
                                
                        @foreach ($yesno as $yesno)
                                <option value="{{ $yesno->YesNoCode }}" {{$yesno->YesNoCode  == 3 ? 'selected' : ''}}>{{ $yesno->YesNoValue }}</option>
                        @endforeach
        
                        
                    </select>
                </div>
    
                <div class="col">
                    <label for="title">How many more children &nbsp;</label>
                    <input type="text" wire:model="ChildHave">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Infertility Case &nbsp;</label>
        
                    <select wire:model="InfertCase">
                                
                        @foreach ($infertilityYesNo as $yesno)
                                <option value="{{ $yesno->YesNoCode }}" {{$yesno->YesNoCode  == 3 ? 'selected' : ''}}>{{ $yesno->YesNoValue }}</option>
                        @endforeach
        
                        
                    </select>
                </div>
    
            </div>
            
            <div style="display: flex;margin-top:10px">
                
                <label for="title">Name of contraceptive method used before &nbsp;</label>
                <input type="text" wire:model="NameContra">
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Previously used contraceptive method &nbsp;</label>
        
                    
                    <select wire:model="ContraBefore" >
                        
                        <option value=""></option>    
                        @foreach ($contraYesNo as $yesno)
                            <option value="{{ $yesno->YesNoCode }}" {{$yesno->YesNoCode  == 3 ? 'selected' : ''}}>{{ $yesno->YesNoValue }}</option>
                        @endforeach
                        
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Contraception Type &nbsp;</label>
                    {{-- In the database there are values like 11. There is no 11 code in the contraceptive type table --}}
                    <select wire:model="ContraceptionType" id="ContraceptionType">
        
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
                <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3">Save</button></td>
                <td><br><a class="btn btn-danger btn-lg px-4 me-sm-3" href="{{ route('casecardsearch') }}">Cancel</a></td>
            </tr>
        </table> 
    </form>
</div>
