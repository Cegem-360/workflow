<?php

use App\Http\Controllers\Api\WorkflowController;
use Illuminate\Support\Facades\Route;

Route::apiResource('workflows', WorkflowController::class);
Route::get('email-templates', [WorkflowController::class, 'emailTemplates']);
Route::post('workflows/actions/email', [WorkflowController::class, 'sendEmail']);
