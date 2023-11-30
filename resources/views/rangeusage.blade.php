@extends('layout')
@section('main')
<div class="container px-5 my-5">
    <h2 style="text-align: center">System Usage from <span style="text-decoration: underline">{{ $startdate }}</span> to <span style="text-decoration: underline">{{ $enddate }}</span></h2>
    <br>
    <div style="text-align: center">
        <input class="" value="{{$startdate}}" type="date" name="startdate" id="startdate">&nbsp; - &nbsp;<input class="" value="{{$enddate}}" type="date" name="enddate" id="enddate"> &nbsp;<button class="btn btn-primary" id="redirectButton">Search</button>
    </div>

    <table id="usageTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>User</th>
                <th style="width: 300px">Daily Register Entries</th>
                <th>Case Cards</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            
            @php
                $pvisitTotal = 0;
                $ccTotal = 0;
                $rowsumTotal = 0;
            @endphp

            @foreach($userRecords as $user)
            @php
                $rowsum = $user->usercount + $user->caseCardCount;
                $rowsumTotal = $rowsumTotal + $rowsum;
                $pvisitTotal = $pvisitTotal + $user->usercount;
                $ccTotal = $ccTotal + $user->caseCardCount;
            @endphp
                <tr>
                    <td>{{ $user->ModifiedBy }}</td> 
                    <td>{{ $user->usercount}}</td>
                    <td>{{ $user->caseCardCount == '' ? '0' : $user->caseCardCount }}</td>
                    <td><strong>{{$rowsum}}</strong></td>
                </tr>
            @endforeach
            
            <tr>
                <td><strong>Total</strong></td> 
                <td><strong>{{$pvisitTotal}}</strong></td>
                <td><strong>{{$ccTotal}}</td>
                <td><strong>{{$rowsumTotal}}</strong></td>
            </tr>
        </tbody>
    </table>
    
</div>
@endsection

@section('scripts')
    <script>
        // Get references to the input field and the button
        var startdate = document.getElementById("startdate");
        var enddate = document.getElementById("enddate");
        var redirectButton = document.getElementById("redirectButton");

        // Add a click event listener to the button
        redirectButton.addEventListener("click", function () {
            // Get the URL entered by the user
            var starturl = startdate.value;
            var endurl = enddate.value;

            // Check if the input is not empty and a valid URL
            if (startdate && enddate) {
                if (starturl > endurl) {
                    alert("Start date must be before end date");
                } else {
                window.location.href = '{{ url('/viewrangeusage') }}/' + starturl + '/' + endurl;
                }
            } else {
                alert("Please select a date.");
            }
        });

    </script>


    <script>
        $(document).ready(function() {
            $('#usageTable').dataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false,
                "bAutoWidth": false });
            });
    </script>
@endsection