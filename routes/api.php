<?php

use App\Http\Resources\TodayTaskResource;
use App\Http\Resources\UpcomingResource;
use App\Models\Today;
use App\Models\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Get the upcoming task
Route::get('/upcoming', function () {
    $upcoming = Upcoming::all();
    return UpcomingResource::collection($upcoming);
});

// Create a new task
Route::post('/upcoming', function (Request $request) {
    return Upcoming::create([
        'title' => $request->title,
        'taskID' => $request->taskID,
        'waiting' => $request->waiting
    ]);
});

// Delete upcoming task
Route::delete('/upcoming/{taskID}', function ($taskID) {
    DB::table('upcomings')->where('taskID', $taskID)->delete();
    return 204;
});


// Get the current task
Route::get('/today-task', function () {
    $todayTask = Today::all();
    return TodayTaskResource::collection($todayTask);
});

// Create today taks
Route::post('/today-task', function (Request $request) {
    return Today::create([
        'id' => $request->id,
        'title' => $request->title,
        'taskID' => $request->taskID
    ]);
});

// Delete today task
Route::delete('/today-task/{taskID}', function ($taskID) {
    DB::table('todays')->where('taskID', $taskID)->delete();
    return 204;
});
