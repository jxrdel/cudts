@extends('layout')
@section('main')
<div class="container px-2 my-2">

{{-- Display errors --}}
    @if($errors->any())
        <div class="alert alert-danger" style="display:flex; justify-content:center">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @livewire('new-case-card')

    
</div>
@endsection

@section('scripts')
<script>
    
    window.addEventListener('display-modal', event => {
            $('#confirmModal').modal('show');
        })
    
    document.getElementById("fff").addEventListener("submit", function(event) 
                {
                    event.preventDefault(); // Prevent the form from submitting by default
                    
                    // Get the values of the start date and end date fields
                    const CaseCardDate = new Date(document.getElementById("CaseCardDate").value);
                    const DateOfBirth = new Date(document.getElementById("DateOfBirth").value);

                    if (!isDateValid(CaseCardDate)){
                        // Checks Date of Visit
                    alert("Please check date of visit");
                    } else if (!isDateValid(DateOfBirth)){
                        // Checks DOB
                    alert("Please check date of discharge");
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
		
		function calculateDateDifference() {
            event.preventDefault();
            const startDateInput = document.getElementById("DateOfBirth");
            const endDateInput = document.getElementById("CaseCardDate");
            const resultElement = document.getElementById("Age");

            if (endDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                const yearDifference = endDate.getFullYear() - startDate.getFullYear();

                resultElement.value = yearDifference;
            } else {
                alert("Date of Birth or Date of Visit is empty");
            }
        }
</script>
    
@endsection