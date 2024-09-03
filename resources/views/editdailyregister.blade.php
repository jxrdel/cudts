@extends('layout')
@section('main')
<div class="container px-5 my-5">

    @if ($dailyregister)
    <div class="row" style="display:flex;justify-content:center;">

            <div class="card" style="max-width: 40rem">
                <h5 class="card-header" style="text-align: center;">Edit Daily Register</h5>
                <form method="POST" id="editDailyRegister" action="{{ route('updatedailyregister') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <input type="text" name="user" value="{{$_SERVER['AUTH_USER']}}" style="display: none">
                        <input type="text" name="DailyRegisterID" value="{{$dailyregister->DailyRegisterID}}" style="display: none">
                        <h5 class="card-title">Date</h5>
                        <input class="form-control form-control-lg" name="Date" type="date" value="{{$dailyregister->formattedDate}}" aria-label=".form-control-lg example">
                        <br>
                        <h5 class="card-title">Clinic</h5>
                        
                        <select class="form-select" name="FacilityID">
                            @php
                                $selectedclinic = $dailyregister->FacilityID;
                            @endphp
                            
                            @foreach ($clinics as $clinic)
                            {{-- Changes selected option to the corresponding Serial--}}
                            <option value="{{ $clinic->FacilityID }}"  {{ $selectedclinic == $clinic->FacilityID ? 'selected' : '' }}>{{ $clinic->FacilityID }}: {{ $clinic->FacilityName }}</option>
                            @endforeach
    
                        </select>
                        <br>
                        <div style="display: flex;justify-content:space-around; text-align:center">
                            <button type="submit" href="#" class="btn btn-primary" style="text-align: center; width:100px;">Save</button>
                            <a href="{{ route('dailyregistersearch') }}" class="btn btn-danger" style="text-align: center; width:100px;">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

    </div>
    @else
        <p>No patient found</p>
    @endif

</div>
@endsection