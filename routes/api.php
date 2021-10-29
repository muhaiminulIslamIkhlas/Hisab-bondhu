<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//User Registration Password Reset & Login
Route::post('/CreateOTP',[UserRegistrationController::class,'CreateOTP']);
Route::post('/OtpVerification',[UserRegistrationController::class,'OtpVerification']);
Route::post('/UserRegistration',[UserRegistrationController::class,'UserRegistration']);
Route::post('/UserLogin',[UserRegistrationController::class,'UserLogin']);
Route::post('/CheckUser',[UserRegistrationController::class,'CheckUser']);
Route::post('/UpdatePassword',[UserRegistrationController::class,'UpdatePassword']);


//contact


Route::post('/ContactFilter',[ContactController::class,'ContactFilter']);
Route::post('/ContactAdd',[ContactController::class,'ContactAdd']);
Route::post('/ContactList',[ContactController::class,'ContactList']);
Route::post('/ContactDetails',[ContactController::class,'ContactDetails']);
Route::post('/ContactUpdate',[ContactController::class,'ContactUpdate']);
Route::post('/ContactDelete',[ContactController::class,'ContactDelete']);



//product
Route::post('/ProductFilter',[ProductController::class,'ProductFilter']);
Route::post('/ProductUnitByType',[ProductController::class,'ProductUnitByType']);
Route::get('/ProductType',[ProductController::class,'ProductType']);
Route::post('/ProductAdd',[ProductController::class,'ProductAdd']);
Route::post('/ProductList',[ProductController::class,'ProductList']);
Route::post('/ProductDetails',[ProductController::class,'ProductDetails']);
Route::post('/ProductUpdate',[ProductController::class,'ProductUpdate']);
Route::post('/ProductDelete',[ProductController::class,'ProductDelete']);


// Home 
Route::post('/HomeCounting',[HomeController::class,'HomeCounting']);


//Invoice
Route::post('/invoiceAdd',[InvoiceController::class,'storeInvoice']);