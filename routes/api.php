<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['api.key'])->prefix('v1')->group(function () {
    Route::get('buildings/{buildingId}/organizations', [OrganizationController::class, 'getOrganizationsByBuilding']);
    Route::get('organizations/search/activity/id/{activityId}', [OrganizationController::class, 'getOrganizationsByActivityId']);
    Route::get('organizations/search/activity/name/{activityName}', [OrganizationController::class, 'getOrganizationsByActivityName']);
    Route::get('organizations/{id}', [OrganizationController::class, 'getOrganizationById']);
    Route::get('organizations/search/name/{name}', [OrganizationController::class, 'getOrganizationsByName']);
    Route::get('organizations/area/radius/{latitude}/{longitude}/{radius}', [OrganizationController::class, 'getOrganizationsInRadius']);
    Route::get('organizations/area/rectangle/{minLat}/{maxLat}/{minLng}/{maxLng}', [OrganizationController::class, 'getOrganizationsInRectangle']);
});

