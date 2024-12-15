<?php

namespace App\Jobs;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientRegisteredMail;

class SendPatientRegisteredEmail implements ShouldQueue
{
    use Queueable;

    protected $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function handle()
    {
        Mail::to($this->patient->email)->send(new PatientRegisteredMail($this->patient));
    }
}

