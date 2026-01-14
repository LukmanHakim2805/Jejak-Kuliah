<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;


// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Profile routes
    Route::put('/profile', [ProfileController::class, 'updateProfile']);
    Route::put('/password', [ProfileController::class, 'updatePassword']);
    
    // Semester routes
    Route::get('/semesters', [SemesterController::class, 'index']);
    Route::post('/semesters', [SemesterController::class, 'store']);
    Route::get('/semesters/{id}', [SemesterController::class, 'show']);
    Route::put('/semesters/{id}', [SemesterController::class, 'update']);
    Route::delete('/semesters/{id}', [SemesterController::class, 'destroy']);
    
    // Course routes (nested under semester)
    Route::get('/semesters/{semesterId}/courses', [CourseController::class, 'index']);
    Route::post('/semesters/{semesterId}/courses', [CourseController::class, 'store']);
    Route::get('/semesters/{semesterId}/courses/{id}', [CourseController::class, 'show']);
    Route::put('/semesters/{semesterId}/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/semesters/{semesterId}/courses/{id}', [CourseController::class, 'destroy']);
    
    // Material routes (nested under course)
    Route::post('/semesters/{semesterId}/courses/{courseId}/materials', [MaterialController::class, 'store']);
    Route::delete('/semesters/{semesterId}/courses/{courseId}/materials/{id}', [MaterialController::class, 'destroy']);
    
    // Books routes
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    
    // Journals routes
    Route::get('/journals', [JournalController::class, 'index']);
    Route::post('/journals', [JournalController::class, 'store']);
    Route::get('/journals/{id}', [JournalController::class, 'show']);
    Route::put('/journals/{id}', [JournalController::class, 'update']);
    Route::delete('/journals/{id}', [JournalController::class, 'destroy']);
    
    // Videos routes
    Route::get('/videos', [VideoController::class, 'index']);
    Route::post('/videos', [VideoController::class, 'store']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);
    Route::put('/videos/{id}', [VideoController::class, 'update']);
    Route::delete('/videos/{id}', [VideoController::class, 'destroy']);
});