@extends('layout')
@section('main')

<div class="container-fluid px-5 my-5">
    <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
        <div class="col" style="text-align: center">
            <a class="btn btn-primary btn-lg px-4 me-sm-3" style="margin-bottom: 10px;justify-content: center; align-items: center;" href="{{ route('newcasecard') }}"> <i class="bi bi-plus-lg"></i> Create a Case Card</a>
        </div>
    </div>
    
    {{-- <livewire:case-card-table/> --}}
    <table id="caseCardSearchTable" class="table table-striped table-bordered" style="">
        <thead>
            <tr>
                <th>Registration Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Clinic</th>
                <th style="display: none">ClinicName</th>
                <th>Edit</th>
            </tr>
        </thead>
    </table>

    
</div>
@endsection

@section('scripts')

{{-- Display notification if action is successful --}}
@if (Session::has('success'))

  <script>
      toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
      }
      toastr.success("{{ Session::get('success') }}",'' , {timeOut:3000});
  </script>

@endif

<script>
    // Initialize DataTable
    $(document).ready(function() {
                $('#caseCardSearchTable').DataTable({
                    "pageLength": 50,
                    order: [[2, 'desc']],
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('getcasecards') }}',
                    columns: [
                        { data: 'RegistrationNumber', name: 'RegistrationNumber' },
                        { data: 'FirstName', name: 'FirstName' },
                        { data: 'LastName', name: 'LastName' },
                        { data: null,
                        "render": function(data, type, row) {
                        return row.ClinicNo + " - " + row.FacilityName},
                        searchable:true
                        , name: 'ClinicNo' },
                        { data: 'FacilityName', name: 'facility.FacilityName', "visible": false },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="/casecardedit/' + data.PatCliNumber + '"><i class="bi bi-pencil-square"></i></a>';
                            }
                        }
                    ]
                });
            });

    
</script>
    
@endsection