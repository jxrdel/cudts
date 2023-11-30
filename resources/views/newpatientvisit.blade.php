@extends('layout')
@section('main')
<div class="container">

    <form method="POST" id="createDailyRegister" action="{{ route('createpatientvisit', ['id' => $drid]) }}">
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


    <input type="text" name="user" value="user" style="display: none">
    <input type="text" name="DailyRegisterID" value="{{$drid}}" style="display: none">
    <input type="text" name="PatCliNumber" value="{{$patient->PatCliNumber}}" style="display: none">
    <div style="margin-bottom:10px" class="p-3 text-primary-emphasis border border-body-subtle rounded-3">
        <div class="row" style="display: flex; justify-content:space-between;">

            <div class="col">
                <label for="title">Case Card Date &nbsp;</label>
                @php
                    $casecarddate = $dailyregister->Date;
                    $casecarddate = \Carbon\Carbon::parse($casecarddate)->format('Y-m-d');
                @endphp
                <input type="date" name="Date" value="{{$casecarddate}}" disabled>
            </div>

            <div class="col" style="text-align: end">
                <label for="title">Clinic &nbsp;</label>
                    
                <select name="FacilityID" disabled>
                            
                    @foreach ($clinic as $clinic)
                            <option value="{{ $clinic->FacilityID }}" {{ $clinic->FacilityID == $dailyregister->FacilityID ? 'selected' : '' }}>{{ $clinic->FacilityName }}</option>
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
                                
                        @foreach ($casetype as $casetype)
                                <option value="{{ $casetype->CaseTypeID }}">{{ $casetype->CaseType }}</option>
                        @endforeach
        
                        
                    </select>
                </div>
    
                <div class="col">
                    <label for="title">Counselling &nbsp;</label>
                    
                    <select name="Counselling" >
                                
                        @foreach ($yesno as $yesno)
                                <option value="{{ $yesno->YesNoCode }}">{{ $yesno->YesNoValue }}</option>
                        @endforeach
        
                        
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
    
                    <label for="title">Pill Qty &nbsp;</label>
                    <input type="number" name="PillQuantity">
                
                </div>
                
    
            </div>
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
    
                <div class="col">
    
                    <label for="title">Foam Tab Qty &nbsp;</label>
                    <input type="number" name="FoamTabQuantity">
                
                </div>
    
                <div class="col">
                    <label for="title">Condom Qty</label>
                    <input type="number"name="CondomQuantity">
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Injection Qty &nbsp;</label>
                    <input type="number" name="InjectionQuantity">
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Seen By &nbsp;</label>
                    
                    <select name="SeenBy" >
                        <option value=""></option>
                                
                        @foreach ($seenby as $seenby)
                                <option value="{{ $seenby->SeenByID }}">{{ $seenby->SeenBy }}</option>
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
                    <input type="number" name="IUCDQuantity">
                </div>
    
                <div class="col">
                    <label for="title">IUCD Ins: &nbsp;</label>
                    
                    <select name="IUCDIns" >
                        <option value=""></option>
                                
                        @foreach ($iucdinsert as $iucdinsert)
                                <option value="{{ $iucdinsert->IUCDCode }}">{{ $iucdinsert->IUCDAction }}</option>
                        @endforeach
        
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">IUCD Exp: &nbsp;</label>
                    <select name="IUCDExp" >
                        <option value=""></option>
                                
                        @foreach ($iucdexp as $iucdexp)
                                <option value="{{ $iucdexp->IUCDExpCo }}">{{ $iucdexp->IUCDExpAct }}</option>
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
                                
                        @foreach ($test as $test)
                                <option value="{{ $test->TestCode }}">{{ $test->TestAction }}</option>
                        @endforeach
        
                    </select>
                </div>
    
                <div class="col">
                    <label for="title">Pap Smear Report &nbsp;</label>
                    <select name="PapSmearReport" >
                        <option value=""></option>
                                
                        @foreach ($papsmear as $papsmear)
                                <option value="{{ $papsmear->PapReportCode }}">{{ $papsmear->PapReportRes }}</option>
                        @endforeach
        
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
    
                    <label for="title">Prostate Test &nbsp;</label>
                    <select name="ProstateTest" >
                        <option value=""></option>
                                
                        @foreach ($prostatetest as $prostatetest)
                                <option value="{{ $prostatetest->TestCode }}">{{ $prostatetest->TestAction }}</option>
                        @endforeach
        
                    </select>
                
                </div>
                
    
            </div>
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
    
                <div class="col">
    
                    <label for="title">Prostate Report: &nbsp;</label>
                    <select name="ProstateReport" >
                        <option value=""></option>
                                
                        @foreach ($prostatereport as $prostatereport)
                                <option value="{{ $prostatereport->ProsRepCode }}">{{ $prostatereport->ProsRepRes }}</option>
                        @endforeach
        
                    </select>
                
                </div>
    
                <div class="col">
                    <label for="title">TL: </label>
                    <select name="TL" >
                        <option value=""></option>
                                
                        @foreach ($tldonereferred as $tldonereferred)
                                <option value="{{ $tldonereferred->DoRefCode }}">{{ $tldonereferred->DoRefAction }}</option>
                        @endforeach
        
                    </select>
                </div>
    
                <div class="col" style="text-align: end">
                    <label for="title">Vasectomy &nbsp;</label>
                    <select name="Vasectomy" >
                        <option value=""></option>
                                
                        @foreach ($vasdonereferred as $vasdonereferred)
                                <option value="{{ $vasdonereferred->DoRefCode }}">{{ $vasdonereferred->DoRefAction }}</option>
                        @endforeach
        
                    </select>
                </div>
    
            </div>
            
            <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
                
                <div class="col">
                    <label for="title">Pregnancy Test &nbsp;</label>
                    <select name="PregnancyTest" >
                                
                        @foreach ($pregnancytest as $pregnancytest)
                                <option value="{{ $pregnancytest->PregTestCode }}" {{ $pregnancytest->PregTestStat == '3 Not Done' ? 'selected' : '' }}>{{ $pregnancytest->PregTestStat }}</option>
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

                <textarea name="Other" id="" rows="3"></textarea>
            
            </div>
        </div>
      </div>

    <table style="display: flex;justify-content: center;align-items:">
        <tr>
            <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
            <td><br><a class="btn btn-danger btn-lg px-4 me-sm-3" href="{{ route('viewpatientvisits', ['id' => $drid]) }}">Cancel</a></td>
        </tr>
    </table> 
</form>

    
</div>


 
@endsection