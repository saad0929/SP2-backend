<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::post('/users', [\App\Http\Controllers\API\UserController::class, 'store']);
Route::put('/users', [\App\Http\Controllers\API\UserController::class, 'updateUser']);
Route::put('/users/{user_id}/onHold', [\App\Http\Controllers\API\UserController::class, 'keepUserOnHold']);
Route::put('/users/{user_id}/request/on_hold', [\App\Http\Controllers\API\UserController::class, 'userOnHoldRequest']);
Route::put('/delete/users', [\App\Http\Controllers\API\UserController::class,'deleteUser']);
Route::get('/users', [\App\Http\Controllers\API\UserController::class, 'fetchUsers']);
Route::get('/users/paginated', [\App\Http\Controllers\API\UserController::class, 'fetchPaginatedUsers']);
Route::get('/users/{user_id}', [\App\Http\Controllers\API\UserController::class, 'fetchUserById']);
Route::get('/users/on_hold/all', [\App\Http\Controllers\API\UserController::class, 'fetchOnHoldUsers']);

// login
Route::post('/users/login', [\App\Http\Controllers\API\UserController::class, 'login']);

// employee
Route::post('/employees', [\App\Http\Controllers\API\EmployeeController::class, 'store']);
Route::put('/employees', [\App\Http\Controllers\API\EmployeeController::class, 'updateEmployee']);
Route::put('/delete/employees', [\App\Http\Controllers\API\EmployeeController::class,'deleteEmployee']);
Route::get('/employees', [\App\Http\Controllers\API\EmployeeController::class, 'fetchEmployees']);
Route::get('/employees/paginated', [\App\Http\Controllers\API\EmployeeController::class, 'fetchPaginatedEmployees']);
Route::get('/employees/{employee_id}', [\App\Http\Controllers\API\EmployeeController::class, 'fetchEmployeeById']);

// admin
Route::post('/admins', [\App\Http\Controllers\API\AdminController::class, 'store']);
Route::put('/admins', [\App\Http\Controllers\API\AdminController::class, 'updateAdmin']);
Route::put('/delete/admins', [\App\Http\Controllers\API\AdminController::class,'deleteAdmin']);
Route::get('/admins', [\App\Http\Controllers\API\AdminController::class, 'fetchAdmins']);
Route::get('/admins/paginated', [\App\Http\Controllers\API\AdminController::class, 'fetchPaginatedAdmins']);
Route::get('/admins/{admin_id}', [\App\Http\Controllers\API\AdminController::class, 'fetchAdminById']);


// book
Route::post('/books', [\App\Http\Controllers\API\BookController::class, 'store']);
Route::post('/books/rating', [\App\Http\Controllers\API\BookController::class, 'storeRating']);
Route::put('/books', [\App\Http\Controllers\API\BookController::class, 'updateBook']);
Route::put('/delete/books', [\App\Http\Controllers\API\BookController::class,'deleteBook']);
Route::get('/books', [\App\Http\Controllers\API\BookController::class, 'fetchBooks']);
Route::get('/books/paginated', [\App\Http\Controllers\API\BookController::class, 'fetchPaginatedBooks']);
Route::get('/books/{book_id}', [\App\Http\Controllers\API\BookController::class, 'fetchBookById']);

//book requests
Route::post('/books/lend/requests', [\App\Http\Controllers\API\BookRequestController::class, 'store']);
Route::put('/books/lend/requests', [\App\Http\Controllers\API\BookRequestController::class, 'updateLendRequest']);
Route::get('/books/lend/requests', [\App\Http\Controllers\API\BookRequestController::class, 'fetchBookLendPendingRequests']);
Route::get('/books/lend/requests/paginated', [\App\Http\Controllers\API\BookRequestController::class, 'fetchBookLendPendingRequestsPaginated']);
Route::get('/users/{user_id}/books/requests', [\App\Http\Controllers\API\BookRequestController::class, 'fetchUserBookingRequests']);
Route::get('/users/{user_id}/books', [\App\Http\Controllers\API\BookRequestController::class, 'fetchUserBookings']);
Route::get('/books/lend/requests/timeOver', [\App\Http\Controllers\API\BookRequestController::class, 'fetchUserExceededBookings']);
