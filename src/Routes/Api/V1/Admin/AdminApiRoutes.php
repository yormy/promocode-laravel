<?php

namespace Yormy\PromocodeLaravel\Routes\Api\V1\Admin;

use Illuminate\Support\Facades\Route;
use Yormy\PromocodeLaravel\Http\Controllers\InviteCodeController;

class AdminApiRoutes
{
    public static function register(): void
    {
        Route::macro('PromocodesApiV1', function (string $prefix = '') {
            Route::prefix('promocodes/invites/'.$prefix)
                ->name('promocodes.invites.')
                ->group(function () {
                    Route::get('/', [InviteCodeController::class, 'index'])->name('index');
//                    Route::post('/', [InviteCodeController::class, 'store'])->name('store');
//                    Route::put('/{code_xid}', [InviteCodeController::class, 'update'])->name('update');
//                    Route::delete('/{code_xid}', [InviteCodeController::class, 'destroy'])->name('destroy');
                });
        });
    }
}
