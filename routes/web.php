<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/workflow-editor', function () {
    return view('admin');
})->name('workflow.editor');

Route::get('/workflows', function () {
    return view('workflows');
})->name('workflows');
