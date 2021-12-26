<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::get('area',            Api\GetAreasListAction::class);
Route::get('area/{ref}',      Api\GetAreaAction::class);
Route::get('city/{ref}',      Api\GetCityAction::class);
Route::get('warehouse/{ref}', Api\GetWarehouseAction::class);
