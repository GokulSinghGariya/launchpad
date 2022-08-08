<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateUserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('user/profile/update',[UpdateUserController::class, 'store'])->name('update_profile');
Route::post('user/profile/update/data',[UpdateUserController::class, 'update'])->name('update_profile_data');



Route::post('teacher/profile/update',[UpdateUserController::class, 'teachers_store'])->name('teachers.update_profile');
Route::post('teacher/profile/update/data',[UpdateUserController::class, 'teachers_update'])->name('teachers.update_profile_data');

Route::get('student/details/{id}',[UpdateUserController::class, 'get_studenet_details'])->name('student.get_studenet_details');

Route::post('teacher/profile/approve',[UpdateUserController::class, 'teachers_approve'])->name('teacher.approve');

Route::post('student/profile/approve',[UpdateUserController::class, 'students_approve'])->name('student.approve');

Route::post('student/asign/teacher',[UpdateUserController::class, 'asign_teacher'])->name('student.asign_teacher');

Route::get('student/notification',[UpdateUserController::class, 'create'])->name('notify.create');


Route::get('/notifications/get', function () {
    $notifications=DB::table('notifications')->where('notifiable_id',Auth::user()->id)->where('read_at',null)->get();
    return response()->json(array('data' => $notifications), 200);


})->name('get_notifications');




Route::get('/read_notification/{id}',[UpdateUserController::class, 'read_notification'])->name('read_notification');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $current_user= Auth::user()->id;

    $user_details=DB::table('students_details')->where('student_id',$current_user)->first();
    $teachers_details=DB::table('teachers_details')->where('teachers_id',$current_user)->first();


    $teachers =DB::table('users')->where('user_type','Teacher')->get();
    $students =DB::table('users')->where('user_type','Student')->get();

    return view('dashboard',compact('user_details','teachers_details','teachers','students'));


})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
