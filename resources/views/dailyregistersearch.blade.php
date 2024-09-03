@extends('layout')
@section('main')
<div class="container px-5 my-5">
    <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
        <div class="col" style="text-align: center">
            <a class="btn btn-primary btn-lg px-4 me-sm-3" style="margin-bottom: 10px;justify-content: center; align-items: center;" data-bs-toggle="modal" data-bs-target="#patientModal"
            href="#"> <i class="bi bi-plus-lg"></i> Create a Daily Register</a>
        </div>
    </div>
	
	<div class="row">
    <div class="col" style="text-align: end">
      <a href="#"><i class="bi bi-question-circle-fill link-primary" data-bs-toggle="modal" data-bs-target="#helpModal"></i></a>
    </div>
  </div>
    <!-- Help Modal -->
    <div class="modal fade modal-sm" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="helpModalLabel">Search Tips <i class="bi bi-info-circle"></i></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           <p>To search for a date, use the format yyyy-mm-dd.</p>
           <p>For example <strong>2000-12-31</strong></p>
           <div class="col" style="text-align: center">
            <button class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" style="margin:auto">Close</button>
          </div>
          </div>
        </div>
      </div>
    </div>
  
  <!-- Modal -->
  <div class="modal fade modal-sm" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="patientModalLabel">Create a Daily Register</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- Form to create daily register --}}
            <form method="POST" id="createDailyRegister" action="{{ route('createdailyregister') }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <input type="text" value="{{$_SERVER['AUTH_USER']}}" name="user" style="display: none">
                  <label for="registerDate" class="form-label">Date</label>
                  <input type="date" class="form-control" id="Date" name="Date" required>
                  <div id="EmailHelp" class="form-text">Select a date for the daily register</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Clinic</label>
                    <select name="FacilityID" class="form-select">
                            
                        @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->FacilityID }}">{{ $clinic->FacilityID }} - {{ $clinic->FacilityName }}</option>
                        @endforeach
        
                        
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="margin:auto">Create</button>
              </form>
        </div>
      </div>
    </div>
  </div>

  
  <table id="dailyregisterSearchTable" class="table table-bordered table-hover" style="">
    <thead>
        <tr>
            <th>Daily Register ID</th>
            <th>Date</th>
            <th>Facility</th>
            <th style="display: none">ClinicName</th>
            <th style="text-align: center">Select</th>
            <th style="text-align: center">Edit</th>
        </tr>
    </thead>
</table>
  
</div>
@endsection

@section('scripts')

<script>
  // Initialize DataTable
  $(document).ready(function() {
              $('#dailyregisterSearchTable').DataTable({
                  "pageLength": 10,
                  order: [[1, 'desc']],
                  processing: true,
                  serverSide: true,
                  ajax: '{{ route('getdailyregisters') }}',
                  columns: [
                      { data: 'DailyRegisterID', name: 'DailyRegisterID' },
                      { data: 'RegisterDate', name: 'dailyregister.Date' },
                      { data: null,
                      "render": function(data, type, row) {
                      return row.FacilityID + " - " + row.FacilityName},
                      searchable:true
                      , name: 'FacilityID' },
                      { data: 'FacilityName', name: 'facility.FacilityName', "visible": false },
                      {
                          data: null,
                          orderable: false,
                          searchable: false,
                          render: function (data, type, row) {
                              return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="/viewpatientvisits/' + data.DailyRegisterID + '"><i class="bi bi-check2-square"></i></a>';
                          }
                      },
                      {
                          data: null,
                          orderable: false,
                          searchable: false,
                          render: function (data, type, row) {
                              return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="/editdailyregister/' + data.DailyRegisterID + '"><i class="bi bi-pencil-square"></i></a>';
                          }
                      }
                  ]
              });
          });

  
</script>

<script>
  document.getElementById("createDailyRegister").addEventListener("submit", function(event) 
                {
                    event.preventDefault(); // Prevent the form from submitting by default
                    
                    // Get the values of the start date and end date fields
                    const RegisterDate = new Date(document.getElementById("Date").value);

                    if (!isDateValid(RegisterDate)){
                        // Checks Date of Visit
                    alert("Date is invalid");
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

{{-- Displays notification if action was successful --}}
@if (Session::has('success'))

  <script>
      toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
      }
      toastr.success("{{ Session::get('success') }}",'' , {timeOut:3000});
  </script>

@endif
    
@endsection

