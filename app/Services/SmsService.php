<?php

namespace App\Services;

use Twilio\Rest\Client;

class SmsService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            env('TWILIO_SID'),
            env('TWILIO_AUTH_TOKEN')
        );
    }

    public function sendSms($to, $message)
    {
        try {
            $this->twilio->messages->create(
                $to, // phone number
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => $message
                ]
            );
        } catch (\Exception $e) {
            // Log Error
        }
    }
}
