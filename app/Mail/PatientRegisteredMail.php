<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function build()
    {
        return $this->subject('Patient Registered')->view('patient_registered');
    }
}
