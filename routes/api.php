<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::post('/register-patient', [PatientController::class, 'register']);
