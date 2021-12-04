<?php

use App\Models\TeacherSurvey;
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

Route::get('/', function () {
    $data = TeacherSurvey::whereHas('student', function($query) {
        $query->where('id', 'F160022');
    })->get()->groupBy('group_teacher_id');
    return view('welcome', [
        'data' => $data
    ]);
});
