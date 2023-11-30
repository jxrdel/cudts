@extends('layout')
@section('main')
<h2 style="padding-top: 20px; text-align:center;text-decoration:underline">CONTRACEPTIVE USAGE AND DISTRIBUTION TRACKING SYSTEM</h2>
<br>
<br>
<br>
<br>
<div class="row gx-5 justify-content-center">

    <!--Case Cards-->
    <div class="col-lg-6 col-xl-4">
        <div class="card mb-5 mb-xl-0" style="min-height: 490px">
            <div class="card-body p-5">
                <div class="mb-3">
                    <h1 style="text-align: center">Case Cards</h1>
                    <br>
                    <p>New Case Cards are completed for new clients who have come to join the clinic.</p>
                    <p>One part of the form is fillable by the nurse/doctor, while the other is done by the sessional clerk.</p>
                </div>
                <div style="margin-top: 100px" class="d-grid"><a class="btn btn-outline-primary" href="{{ route('casecardsearch') }}"> <i class="bi bi-person-vcard"></i> View Case Cards</a></div>
            </div>
        </div>
    </div>
    
    <!-- Daily Registers-->
    <div class="col-lg-6 col-xl-4">
        <div class="card mb-5 mb-xl-0" style="min-height: 490px">
            <div class="card-body p-5">
                <div class="mb-3">
                    <h1 style="text-align: center">Daily Registers</h1>
                    <br>
                    <p>Daily Registers contain the information of all persons visiting a clinic for a particular day.</p> 

                    <p>These include, new clients, walk-ins, re-visits etc. </p>
                    
                    <p>Information on what service received is also recorded on the daily register</p>
                    
                </div>
                <div style="margin-top: 60px" class="d-grid" style="padding-top: 20px"><a class="btn btn-outline-primary" href="{{ route('dailyregistersearch') }}"> <i class="bi bi-journal-text"></i> View Daily Registers</a></div>
            </div>
        </div>
    </div>

    
    
    
    
</div>

 
@endsection