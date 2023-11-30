<?php

namespace App\Rules;

use App\Models\Patient;
use Illuminate\Contracts\Validation\Rule;

class PatientRegNo implements Rule
{
    protected $clinicno;
    public function __construct($hospitalId)
    {
        $this->clinicno = $hospitalId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !Patient::where('RegistrationNumber', $value)
            ->where('ClinicNo', $this->clinicno)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Registration number already exists for this clinic. Please enter a unique registration number';
    }
}
