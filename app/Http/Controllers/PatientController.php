<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendPatientRegisteredEmail;
use App\Services\SmsService;

class PatientController extends Controller
{


    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }



    public function register(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'document_photo' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Register Patient
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'document_photo' => $request->file('document_photo')->store('documents', 'public'),
        ]);

        // Send email
        dispatch(new SendPatientRegisteredEmail($patient));

        // Send SMS !!!Future!!!
        // $this->smsService->sendSms($patient->phone, 'Your registration is successful!');

        return response()->json(['message' => 'Patient registered successfully.'], 201);
    }
}
