<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppointmentTimeController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Assistant\AssistantAppointmentController;
use App\Http\Controllers\Assistant\AssistantDashboard;
use App\Http\Controllers\Doctor\DoctorAppointmentController;
use App\Http\Controllers\Doctor\DoctorDashboard;
use App\Http\Controllers\Patient\PatientAppointmentController;
use App\Http\Controllers\Patient\PatientDashboard;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Website Routes.
Route::controller(WebsiteController::class)->group(function(){
    Route::get('/', 'index')->name('welcome');
});


// Authentication routes.
Auth::routes(['verify'=> true]);


// Admin Routes
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'verified', 'admin']], function () {
    Route::get('dashbord', [AdminDashboard::class, 'index'])->name('dashboard');

    // Appointment Times
    Route::controller(AppointmentTimeController::class)->group(function(){
        Route::get('appointment-sessions', 'index')->name('appointment-sessions');
        Route::post('appointment-sessions-store', 'store')->name('appointment-sessions-store');
        Route::put('appointment-sessions-update/{id}', 'update')->name('appointment-sessions-update');
    });

    // Department Routes
    Route::controller(DepartmentController::class)->group(function(){
        Route::get('departments', 'index')->name('departments');
        Route::post('department-store','store')->name('department-store');
        Route::put('department-update/{id}', 'update')->name('department-update');
    });

    // Province Controller
    Route::controller(ProvinceController::class)->group(function(){
        Route::get('province', 'index')->name('province');
        Route::post('province-store', 'store')->name('province-store');
        Route::put('province-update/{id}', 'update')->name('province-update');
    });

    // District Controller
    Route::controller(DistrictController::class)->group(function(){
        Route::get('district', 'index')->name('district');
        Route::post('district-store', 'store')->name('district-store');
        Route::put('district-update/{id}', 'update')->name('district-update');
    });

    // Patient Route Resource
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::patch('close/{id}', [AppointmentController::class, 'close'])->name('appointments.close');

});


// Doctor Routes
Route::group(['as' => 'doctor.', 'prefix' => 'doctor', 'namespace' => 'App\Http\Controllers\Doctor', 'middleware' => ['auth', 'verified', 'doctor']], function () {
    Route::get('dashbord', [DoctorDashboard::class, 'index'])->name('dashboard');

    // Appointment Doctor can only view(index) and close.
    Route::controller(DoctorAppointmentController::class)->group(function(){
        Route::get('appointments', 'index')->name('appointments');
        Route::patch('close/{id}', [DoctorAppointmentController::class, 'close'])->name('appointments.close');
    });
});


// Assistant Routes
Route::group(['as' => 'assistant.', 'prefix' => 'assistant', 'namespace' => 'App\Http\Controllers\Assistant', 'middleware' => ['auth', 'verified', 'assistant']], function () {
    Route::get('dashbord', [AssistantDashboard::class, 'index'])->name('dashboard');

    // Appointment
    Route::resource('appointments', AssistantAppointmentController::class);
    Route::patch('close/{id}', [AssistantAppointmentController::class, 'close'])->name('appointments.close');
});


// Patient Routes
Route::group(['as' => 'patient.', 'prefix' => 'patient', 'namespace' => 'App\Http\Controllers\Patient', 'middleware' => ['auth', 'verified', 'patient']], function () {
    Route::get('dashbord', [PatientDashboard::class, 'index'])->name('dashboard');

    // Appointments Patient can only index, create and edit an appointment
    Route::resource('appointments', PatientAppointmentController::class);
});
