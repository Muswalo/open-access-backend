<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InventoryController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\SaleController;
use App\Http\Controllers\API\V1\SaleItemController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\StoreController;

Route::group(['prefix'=>'v1'], function (){

    Route::apiResource('users', UserController::class);
    Route::apiResource('stores', StoreController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('sales', SaleController::class);
    Route::apiResource('sale-items', SaleItemController::class);
    Route::apiResource('inventories', InventoryController::class);
    Route::apiResource('logins', LoginController::class);
    Route::apiResource('reports', ReportController::class);
    Route::apiResource('notifications', NotificationController::class);
    
});


