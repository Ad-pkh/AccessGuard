<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Company\Http\Controllers\CompanyController;

Route::prefix('v1')->group(function (): void {
    Route::apiResource('companies', CompanyController::class)->names('company');
});
