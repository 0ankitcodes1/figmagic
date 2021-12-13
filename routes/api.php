<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CreatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TemporaryController;
use App\Http\Controllers\PermanentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WebInfoController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CollaboratorController;

use App\Http\Middleware\EnsureRequestIsAvailable;

use App\Http\Middleware\BlockMiddleware;

Route::group(["prefix" => "v1"], function() {
    Route::get('user', [CreatorController::class, 'index']);
    Route::get('user/{id}', [CreatorController::class, 'show']);
    Route::post('user', [CreatorController::class, 'create']);
    Route::post('user/change', [CreatorController::class, 'update']);
    Route::post('user/delete', [CreatorController::class, 'destroy']);
    Route::post('user/login', [CreatorController::class, 'login']);
    Route::post('user/logout', [CreatorController::class, 'logout']);
    Route::post('user/figma/login', [CreatorController::class, 'login_figma']);
    Route::post('user/figma/logout', [CreatorController::class, 'logout_figma']);

    Route::post('user/verify', [CreatorController::class, 'verify']);
    Route::post('user/checkuser', [CreatorController::class, 'checkuser']);
    Route::post('user/resend', [CreatorController::class, 'resend']);
    Route::post('user/forgot', [CreatorController::class, 'forgotPassword']);
    Route::get('user/signup/google', [CreatorController::class, 'googleSignup']);


    Route::get('admin', [AdminController::class, 'index']);
    Route::get('admin/{id}', [AdminController::class, 'show']);
    Route::post('admin', [AdminController::class, 'create']);
    Route::post('admin/change', [AdminController::class, 'update']);
    Route::post('admin/delete', [AdminController::class, 'destroy']);
    Route::post('admin/login', [AdminController::class, 'login']);
    Route::post('admin/logout', [AdminController::class, 'logout']);
    Route::post('admin/verify', [AdminController::class, 'verify']);
    Route::post('admin/checkuser', [AdminController::class, 'checkuser']);
    Route::post('admin/resend', [AdminController::class, 'resend']);
    Route::post('admin/forgot', [AdminController::class, 'forgotPassword']);
    Route::get('admin/now/fill-webinfo', [AdminController::class, 'fillWebInfo']);
    Route::get('admin/now/fill-page', [AdminController::class, 'fillPage']);


    Route::post('temp/all', [TemporaryController::class, 'index'])->middleware(EnsureRequestIsAvailable::class);
    Route::get('temp/{id}', [TemporaryController::class, 'show']);
    Route::post('temp', [TemporaryController::class, 'create']);
    Route::post('temp/change', [TemporaryController::class, 'update']);
    Route::post('temp/transfer', [TemporaryController::class, 'transfer']);
    Route::post('temp/delete', [TemporaryController::class, 'destroy']);

    Route::post('per/all', [PermanentController::class, 'index']);
    Route::post('per/single', [PermanentController::class, 'show']);
    // Route::post('per', [PermanentController::class, 'create']);
    Route::post('per/change', [PermanentController::class, 'update']);
    Route::post('per/delete', [PermanentController::class, 'destroy']);

    Route::get('file', [FileController::class, 'index']);
    Route::get('file/{id}', [FileController::class, 'show']);
    Route::post('file', [FileController::class, 'create']);
    Route::put('file/{id}', [FileController::class, 'update']);
    Route::delete('file/{id}', [FileController::class, 'destroy']);

    Route::post('all/web-info', [WebInfoController::class, 'index'])->middleware(BlockMiddleware::class);
    Route::get('web-info/{id}', [WebInfoController::class, 'show'])->middleware(BlockMiddleware::class);
    Route::post('web-info', [WebInfoController::class, 'create'])->middleware(BlockMiddleware::class);
    Route::post('web-info/update/{id}', [WebInfoController::class, 'update'])->middleware(BlockMiddleware::class);
    Route::delete('web-info/{id}', [WebInfoController::class, 'destroy'])->middleware(BlockMiddleware::class);

    Route::post('all/page-info', [PageController::class, 'index'])->middleware(BlockMiddleware::class);
    Route::get('page-info/{id}', [PageController::class, 'show'])->middleware(BlockMiddleware::class);
    Route::post('page-info', [PageController::class, 'create'])->middleware(BlockMiddleware::class);
    Route::post('page-info/update/{id}', [PageController::class, 'update'])->middleware(BlockMiddleware::class);
    Route::delete('page-info/{id}', [PageController::class, 'destroy'])->middleware(BlockMiddleware::class);


    Route::get('collaborator', [CollaboratorController::class, 'index']);
    Route::get('collaborator/{id}', [CollaboratorController::class, 'show']);
    Route::post('collaborator', [CollaboratorController::class, 'create']);
    Route::post('collaborator/show/specific', [CollaboratorController::class, 'showSpecific']);
    Route::post('collaborator/change', [CollaboratorController::class, 'update']);
    Route::post('collaborator/delete/{id}', [CollaboratorController::class, 'destroy']);
    Route::post('collaborator/login', [CollaboratorController::class, 'login']);
    Route::post('collaborator/logout', [CollaboratorController::class, 'logout']);
    Route::post('collaborator/remove/all-content', [CollaboratorController::class, 'destroyContent']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
