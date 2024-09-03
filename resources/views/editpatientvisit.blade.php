@extends('layout')
@section('main')
<div class="container">



    <form method="POST" id="updatedailyregister" action="{{ route('updatepatientvisit') }}">
        @csrf
        @method('PUT')
    
    
        <div class="row">
            <div class="col">
                <p>
                    <h4>Patient Name: {{$patient->FirstName}} {{$patient->LastName}}</h4>
                </p>
            </div>
            
            <div class="col">
                <p>
                    <h4>Registration # {{$patient->RegistrationNumber}}</h4>
                </p>
            </div>
    
            
    
        </div>
    
    
        <input type="text" name="user" value="{{$_SERVER['AUTH_USER']}}" style="display: none">
        <input type="text" name="PatCliNumber" value="{{$patientvisit->PatCliNumber}}" style="display: none">
        <input type="text" name="DailyRegisterID" value="{{$patientvisit->DailyRegisterID}}" style="display: none">
        <input type="text" name="PatientVisitID" value="{{$patientvisit->PatientVisitID}}" style="display: none">

        <div style="margin-bottom:10px" class="p-3 text-primary-emphasis border border-body-subtle rounded-3">
            <div class="row" style="display: flex; justify-content:space-between;">
    
                <div class="col">
                    @php
                        $casecarddate = $patientvisit->CaseCardDate;
                        $casecarddate = \Carbon\Carbon::parse($casecarddate)->format('Y-m-d');
                    @endphp
                    <label for="title">Case Card Date: &nbsp;</label>
					<strong>{{$casecarddate}}</strong>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Clinic &nbsp;</label>
                        
                    <select name="FacilityID" disabled>

                        @php
                            $selectedFacilityID = $dailyregister->FacilityID
                        @endphp
                                
                        @foreach ($clinic as $clinic)
                                <option value="{{ $clinic->FacilityID }}" {{ $selectedFacilityID == $clinic->FacilityID ? 'selected' : '' }}>{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                        @endforeach
        
                        
                    </select>
                </div>
    
            </div>
    
        </div>
    
        <div class="card" style="margin-bottom: 10px">
            <h5 class="card-header">Quantity Issued This Visit</h5>
            <div class="card-body">
                <div class="row" style="display: flex; justify-content:space-between;">
    
                    <div class="col">
                        <label for="title">Case Type &nbsp;</label>
                        <select name="CaseType" >
                            @php
                                $selectedCaseType = $patientvisit->CaseType;
                            @endphp
                                    <p>{{$selectedCaseType}}</p>
                            @foreach ($casetype as $casetype)
                                    <option value="{{ $casetype->CaseTypeID }}" {{ $selectedCaseType == $casetype->CaseTypeID ? 'selected' : '' }}>{{ $casetype->CaseType }}</option>
                            @endforeach
            
                            
                        </select>
                    </div>
        
                    <div class="col">
                        <label for="title">Counselling &nbsp;</label>
                        
                        <select name="Counselling" >
                            @php
                                $selectedCounselling = $patientvisit->Counselling;
                            @endphp
                                    
                            @foreach ($yesno as $yesno)
                                    <option value="{{ $yesno->YesNoCode }}" {{ $selectedCounselling == $yesno->YesNoCode ? 'selected' : '' }}>{{ $yesno->YesNoValue }}</option>
                            @endforeach
            
                            
                        </select>
                    </div>
        
                    <div class="col" style="text-align: end">
        
                        <label for="title">Pill Qty &nbsp;</label>
                        <input type="number" name="PillQuantity" value="{{$patientvisit->PillQuantity}}">
                    
                    </div>
                    
        
                </div>
                <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
        
                    <div class="col">
        
                        <label for="title">Foam Tab Qty &nbsp;</label>
                        <input type="number" name="FoamTabQuantity" value="{{$patientvisit->FoamTabQuantity}}">
                    
                    </div>
        
                    <div class="col">
                        <label for="title">Condom Qty</label>
                        <input type="number"name="CondomQuantity" value="{{$patientvisit->CondomQuantity}}">
                    </div>
        
                    <div class="col" style="text-align: end">
                        <label for="title">Injection Qty &nbsp;</label>
                        <input type="number" name="InjectionQuantity" value="{{$patientvisit->InjectionQuantity}}">
                    </div>
        
                </div>
                
                <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                    
                    <div class="col">
                        <label for="title">Seen By &nbsp;</label>
                        
                        <select name="SeenBy" >
                            <option value=""></option>
                            @php
                                $selectedSeenBy = $patientvisit->SeenBy;
                            @endphp
                                    
                            @foreach ($seenby as $seenby)
                                    <option value="{{ $seenby->SeenByID }}" {{ $selectedSeenBy == $seenby->SeenByID ? 'selected' : '' }}>{{ $seenby->SeenByID }} {{ $seenby->SeenBy }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                </div>
            </div>
          </div>
    
          <div class="card" style="padding-bottom: 10px; margin-top:10px">
            <h5 class="card-header">IUCD Events</h5>
            <div class="card-body">
                <div class="row" style="display: flex; justify-content:space-between;">
                
                    <div class="col">
                        <label for="title">IUCD Qty: &nbsp;</label>
                        <input type="number" name="IUCDQuantity" value="{{$patientvisit->IUCDQuantity}}">
                    </div>
        
                    <div class="col">
                        <label for="title">IUCD Ins: &nbsp;</label>
                        
                        <select name="IUCDIns" >
                            <option value=""></option>
                            @php
                                $selectedIUCDIns = $patientvisit->IUCDIns;
                            @endphp
                                    
                            @foreach ($iucdinsert as $iucdinsert)
                                    <option value="{{ $iucdinsert->IUCDCode }}" {{ $selectedIUCDIns == $iucdinsert->IUCDCode ? 'selected' : '' }}>{{ $iucdinsert->IUCDAction }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                    <div class="col" style="text-align: end">
                        <label for="title">IUCD Exp: &nbsp;</label>
                        <select name="IUCDExp" >
                            <option value=""></option>
                            @php
                                $selectedIUCDExp = $patientvisit->IUCDExp;
                            @endphp
                                    
                            @foreach ($iucdexp as $iucdexp)
                                    <option value="{{ $iucdexp->IUCDExpCo }}" {{ $selectedIUCDExp == $iucdexp->IUCDExpCo ? 'selected' : '' }}>{{ $iucdexp->IUCDExpAct }}</option>
                            @endforeach
            
                        </select>
                    </div>
                </div>
            </div>
          </div>
    
        
    <div class="card" style="padding-bottom: 10px; margin-top:10px">
            <h5 class="card-header">Other Services</h5>
            <div class="card-body">
                <div class="row" style="display: flex; justify-content:space-between;">
    
                    <div class="col">
                        <label for="title">Pap Smear Test &nbsp;</label>
                        <select name="PapSmearTest" >
                            <option value=""></option>
                            @php
                                $selectedPapSmearTest = $patientvisit->PapSmearTest
                            @endphp
                                    
                            @foreach ($test as $test)
                                    <option value="{{ $test->TestCode }}" {{ $selectedPapSmearTest == $test->TestCode ? 'selected' : '' }}>{{ $test->TestAction }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                    <div class="col">
                        <label for="title">Pap Smear Report &nbsp;</label>
                        <select name="PapSmearReport" >
                            <option value=""></option>
                            @php
                                $selectedPapSmearReport = $patientvisit->PapSmearReport
                            @endphp
                                    
                            @foreach ($papsmear as $papsmear)
                                    <option value="{{ $papsmear->PapReportCode }}" {{ $selectedPapSmearReport == $papsmear->PapReportCode ? 'selected' : '' }}>{{ $papsmear->PapReportRes }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                    <div class="col" style="text-align: end">
        
                        <label for="title">Prostate Test &nbsp;</label>
                        <select name="ProstateTest" >
                            <option value=""></option>
                            @php
                                $selectedProstateTest = $patientvisit->ProstateTest
                            @endphp
                                    
                            @foreach ($prostatetest as $prostatetest)
                                    <option value="{{ $prostatetest->TestCode }}" {{ $selectedProstateTest == $prostatetest->TestCode ? 'selected' : '' }}>{{ $prostatetest->TestAction }}</option>
                            @endforeach
            
                        </select>
                    
                    </div>
                    
        
                </div>
                <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
        
                    <div class="col">
        
                        <label for="title">Prostate Report: &nbsp;</label>
                        <select name="ProstateReport" >
                            <option value=""></option>
                            @php
                                $selectedProstateReport = $patientvisit->ProstateReport
                            @endphp
                                    
                            @foreach ($prostatereport as $prostatereport)
                                    <option value="{{ $prostatereport->ProsRepCode }}" {{ $selectedProstateReport == $prostatereport->ProsRepCode ? 'selected' : '' }}>{{ $prostatereport->ProsRepRes }}</option>
                            @endforeach
            
                        </select>
                    
                    </div>
        
                    <div class="col">
                        <label for="title">TL: </label>
                        <select name="TL" >
                            <option value=""></option>
                            @php
                                $selectedTL = $patientvisit->TL
                            @endphp
                                    
                            @foreach ($tldonereferred as $tldonereferred)
                                    <option value="{{ $tldonereferred->DoRefCode }}" {{ $selectedTL == $tldonereferred->DoRefCode ? 'selected' : '' }}>{{ $tldonereferred->DoRefAction }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                    <div class="col" style="text-align: end">
                        <label for="title">Vasectomy &nbsp;</label>
                        <select name="Vasectomy" >
                            <option value=""></option>
                            @php
                                $selectedVasectomy = $patientvisit->Vasectomy
                            @endphp
                                    
                            @foreach ($vasdonereferred as $vasdonereferred)
                                    <option value="{{ $vasdonereferred->DoRefCode }}" {{ $selectedVasectomy == $vasdonereferred->DoRefCode ? 'selected' : '' }}>{{ $vasdonereferred->DoRefAction }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                </div>
                
                <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                    
                    <div class="col">
                        <label for="title">Pregnancy Test &nbsp;</label>
                        <select name="PregnancyTest" >
                            @php
                                $selectedPregnancyTest = $patientvisit->PregnancyTest
                            @endphp
                                    
                            @foreach ($pregnancytest as $pregnancytest)
                                    <option value="{{ $pregnancytest->PregTestCode }}" {{ $selectedPregnancyTest == $pregnancytest->PregTestCode ? 'selected' : '' }}>{{ $pregnancytest->PregTestStat }}</option>
                            @endforeach
            
                        </select>
                    </div>
        
                </div>
            </div>
          </div>
    
          
          <div class="card" style="padding-bottom: 10px; margin-top:10px">
            <h5 class="card-header">Other</h5>
            <div class="card-body">
                <div class="row" style="display: flex; justify-content:space-between;">
    
                    <textarea name="Other" id="" rows="3">{{$patientvisit->Other}}</textarea>
                
                </div>
            </div>
          </div>
    
        <table style="display: flex;justify-content: center;align-items:">
            <tr>
                <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
                <td><br><a class="btn btn-danger btn-lg px-4 me-sm-3" href="{{ route('viewpatientvisits', ['id' => $patientvisit->DailyRegisterID]) }}">Cancel</a></td>
            </tr>
        </table> 
    </form>



    

    
</div>


 
@endsection