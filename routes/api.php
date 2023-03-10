<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\LabController;
use App\Http\Controllers\API\TestcenterController;
use App\Http\Controllers\API\AttachmentController;
use App\Http\Controllers\API\MedicineorderController;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\API\DoctorDetailsController;
use App\Http\Controllers\API\AppointmentController;


  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
Route::post('login', [AuthController::class, 'signin']);
Route::post('sendotp', [AuthController::class, 'sendotp']);
Route::post('register', [AuthController::class, 'signup']);
Route::get('test', [AuthController::class, 'test']);




Route::middleware('auth:sanctum')->group( function () {
    Route::resource('patients', PatientController::class);
    Route::resource('labtest', LabController::class);
    Route::resource('testcenters', TestcenterController::class);
    Route::resource('attachments', AttachmentController::class);
    Route::post('/patient_request/{type}', [App\Http\Controllers\API\PatientRequestController::class, 'store']);
    Route::get('/patient_request', [App\Http\Controllers\API\PatientRequestController::class, 'index']);
    Route::post('/user_feedback', [App\Http\Controllers\API\UserFeedBackController::class, 'store']);
    Route::resource('medicine-order', MedicineorderController::class);
    Route::get('/get-address', [App\Http\Controllers\API\LabController::class, 'getAllAddress']);
    Route::post('/add-delivery-address', [App\Http\Controllers\API\LabController::class, 'addAddress']);
    Route::put('/medicine-order-cancel/{medicineorder}', [App\Http\Controllers\API\MedicineorderController::class, 'cancel']);
    Route::put('/labtest-cancel/{labtest}', [App\Http\Controllers\API\MedicineorderController::class, 'cancel']);
    Route::resource('doctor/details', DoctorDetailsController::class);
    Route::resource('appointment', AppointmentController::class);

    Route::post('/add-city', [App\Http\Controllers\API\CityController::class, 'store']);
    Route::post('/add-specialization', [App\Http\Controllers\API\CityController::class, 'specializationStore']);
    Route::post('/add-hospital', [App\Http\Controllers\API\CityController::class, 'hospitalStore']);
    Route::get('/hospital', [App\Http\Controllers\API\CityController::class, 'hospitalList']);
    Route::get('/specialization', [App\Http\Controllers\API\CityController::class, 'specializationList']);
    Route::get('/city-list', [App\Http\Controllers\API\CityController::class, 'cityList']);
    Route::get('/symptoms-list', [App\Http\Controllers\API\CityController::class, 'symptomsList']);
    Route::get('/doctor-list', [App\Http\Controllers\API\DoctorDetailsController::class, 'doctorList']);


    Route::get('/doctorAppointment-list', [App\Http\Controllers\API\DoctorDetailsController::class, 'appointmentList']);
    Route::post('/filterBy', [App\Http\Controllers\API\DoctorDetailsController::class, 'filterBy']);
    Route::get('/get-slots/{id}', [App\Http\Controllers\API\DoctorDetailsController::class, 'getSlots']);
    Route::get('/get-cities/{id}', [App\Http\Controllers\API\DoctorDetailsController::class, 'getCities']);
    Route::get('/get-hospital/{id}', [App\Http\Controllers\API\DoctorDetailsController::class, 'getHospital']);
    Route::get('/get-specialization/{id}', [App\Http\Controllers\API\DoctorDetailsController::class, 'getSpecialization']);
    Route::get('/get-symptoms/{id}', [App\Http\Controllers\API\DoctorDetailsController::class, 'getSymptoms']);


    Route::post('/prescription-details', [App\Http\Controllers\API\PrescriptionController::class, 'store']);

    Route::get('/appointment-consultation', [App\Http\Controllers\API\AppointmentController::class, 'appointmentConsultation']);
    Route::get('/all-prescription/{id}', [App\Http\Controllers\API\AppointmentController::class, 'allPrescriptionMedicine']);


});

