@extends('layout')
@section('main')
<div class="container px-5 my-5">
    <h2 style="text-align: center">System Usage on <span style="text-decoration: underline">{{ $date }}</span></h2>
    <br>
    <div style="text-align: center">
        <input class="" value="{{$date}}" type="date" name="usagedate" id="usagedate"> &nbsp; <button class="btn btn-primary" id="redirectButton">Search</button>
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
            
        </tbody>
		<tfoot>
            <tr>
                <td><strong>Total</strong></td> 
                <td><strong>{{$pvisitTotal}}</strong></td>
                <td><strong>{{$ccTotal}}</td>
                <td><strong>{{$rowsumTotal}}</strong></td>
            </tr>
		</tfoot>
    </table>
    
</div>
@endsection

@section('scripts')
    <script>
        // Get references to the input field and the button
        var pageInput = document.getElementById("usagedate");
        var redirectButton = document.getElementById("redirectButton");

        // Add a click event listener to the button
        redirectButton.addEventListener("click", function () {
            // Get the URL entered by the user
            var url = pageInput.value;

            // Check if the input is not empty and a valid URL
            if (url) {
                // Redirect to the entered URL
                window.location.href = '{{ url('/viewdailyusage') }}/' + url;
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