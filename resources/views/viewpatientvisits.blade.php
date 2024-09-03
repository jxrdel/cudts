@extends('layout')

@section('styles')
    
@endsection

@section('main')
<div class="container px-5 my-5">
    <div class="row" style="display: flex; justify-content:space-between;margin-top:10px">
            
        <div class="col" style="text-align: center">
            <a class="btn btn-primary btn-lg px-4 me-sm-3" style="margin-bottom: 10px;justify-content: center; align-items: center;" data-bs-toggle="modal" data-bs-target="#visitModal"
            href="#"> <i class="bi bi-plus-lg"></i> Add Patient Visit</a>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade modal-xl" id="visitModal" tabindex="-1" aria-labelledby="visitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="visitModalLabel">Create a Daily Register</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @livewire('patient-table', ['dailyregisterid' => $dailyregisterid])
        </div>
      </div>
    </div>
  </div>
    <table id="visitTable" class="table table-striped table-bordered" width="100%">
      <thead>
          <tr>
              <th>Patient Visit</th>
              <th>Registration Number</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($records as $record)
          <tr>
              <td>{{ $record->PatientVisitID }}</td>
              <td>{{ $record->RegistrationNumber }}</td>
              <td>{{ $record->FirstName }}</td>
              <td>{{ $record->LastName }}</td>
              <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('editpatientvisit', ['id' => $record->PatientVisitID]) }}"><i class="bi bi-pencil-square"></i></a></td>
              <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 link-dark" href="{{ route('deletepatientvisit', ['id' => $record->PatientVisitID, 'drid' => $dailyregisterid]) }}"><i class="bi bi-trash3"></i></a></td>
          </tr>
          @endforeach
      </tbody>
  </table>
    
</div>
@endsection

@section('scripts')
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
      new DataTable('#visitTable');
    </script>
@endsection

