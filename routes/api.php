<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
  
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

/** For Login & Logout  */
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function (){
     Route::post('/logout', [AuthController::class, 'logout']);
});
   
    /***
     * API route
     */
    Route::group(['middleware' => ['auth:sanctum']], function()  
    {

        Route::post('/add-a-employee'                     , [App\Http\Controllers\TaskController::class , 'addEmployee']);
        Route::get('/all-employee-list'                   ,[App\Http\Controllers\TaskController::class , 'getAllEmployee']);
        Route::get('/delete-a-employee/{employeeId}'      ,[App\Http\Controllers\TaskController::class , 'deleteEmployee']);
        Route::get('/get-a-employee-details/{employeeId}'  ,[App\Http\Controllers\TaskController::class , 'getEmployeeDetails']);
        Route::post('/edit-the-employee'                   ,[App\Http\Controllers\TaskController::class , 'updateEmployee']);

        Route::get('/only-employee-name-list'               ,[App\Http\Controllers\TaskController::class , 'onlyEmployeesName']);
        Route::post('/add-task'                             , [App\Http\Controllers\TaskController::class , 'addTask']);
        Route::get('/all-task-list'                         ,[App\Http\Controllers\TaskController::class , 'getAllTask']);
        Route::get('/get-a-task-details/{taskId}'           ,[App\Http\Controllers\TaskController::class , 'getTaskDetails']);
        Route::post('/update-task'                         ,[App\Http\Controllers\TaskController::class , 'updateTask']);
        Route::get('/delete-task/{taskId}'                 ,[App\Http\Controllers\TaskController::class , 'deleteTask']);
        Route::post('/filter-task'                   ,[App\Http\Controllers\TaskController::class , 'filterTask']);

        Route::get('/dashboard-card-data'           ,[App\Http\Controllers\TaskController::class , 'getDashboardCard']);

        Route::get('/only-user-task'                 ,[App\Http\Controllers\TaskController::class , 'userTaskDetails']);

        Route::get('/user-dashboard-card-data/{phone}'           ,[App\Http\Controllers\TaskController::class , 'getDashboardCardUser']);
        Route::get('/user-only-employee-name-list/{phone}'       ,[App\Http\Controllers\TaskController::class , 'onlyUserEmployeesName']);
        Route::post('/filter-employee'                           ,[App\Http\Controllers\TaskController::class , 'filterEmployee']);




       
    });