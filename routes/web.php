<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DonorAdminController;
use App\Http\Controllers\Admin\OrganizationAdminController;
use App\Http\Controllers\Admin\ProgramAdminController;
use App\Http\Controllers\Admin\RoleAdminController;
use App\Http\Controllers\Admin\WithdrawAdminController;
use App\Http\Controllers\Organization\DashboardOrganizationController;
use App\Http\Controllers\Organization\ProfileOrganizationController;
use App\Http\Controllers\Organization\ProgramOrganizationController;
use App\Http\Controllers\Organization\WithdrawOrganizationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/program', [HomeController::class, 'program'])->name('program');
Route::get('/program-done', [HomeController::class, 'program_done'])->name('program.done');
Route::get('/program/{program}', [HomeController::class, 'program_detail'])->name('program.detail');
Route::get('/recap', [HomeController::class, 'recapitulate'])->name('recap');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::middleware(['auth','verified','donor'])->group(function () {
    Route::get('/profile', [HomeController::class, 'donor_profile'])->name('donor.profile');
    Route::put('/profile', [HomeController::class, 'donor_profile_update'])->name('donor.profile.update');
    Route::get('/data-donation', [HomeController::class, 'donor_data_donation'])->name('donor.data.donation');
    Route::get('/donation/{program}', [DonationController::class, 'create'])->name('donation.create');
    Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');        
});

Auth::routes(['verify' => true]);

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin');

    Route::resource('category', CategoryAdminController::class, ['as' => 'admin']);
    Route::resource('program', ProgramAdminController::class, ['as' => 'admin']); 
    Route::resource('role', RoleAdminController::class, ['as' => 'admin'])->only(['index']);  
    
    Route::prefix('withdraw')->group(function () {
        Route::get('/submission', [WithdrawAdminController::class, 'submissionIndex'])->name('admin.withdraw.submission');
        Route::put('/approved/{program}', [WithdrawAdminController::class, 'approvedUpdate'])->name('admin.withdraw.approved.update');
        Route::get('/approved', [WithdrawAdminController::class, 'approvedIndex'])->name('admin.withdraw.approved');
        Route::put('/finished/{program}', [WithdrawAdminController::class, 'finishedUpdate'])->name('admin.withdraw.finished.update');
        Route::get('/finished', [WithdrawAdminController::class, 'finishedIndex'])->name('admin.withdraw.finished');
    });

    Route::prefix('account')->group(function () {
        Route::get('/', [AccountAdminController::class, 'index'])->name('admin.account.index');
        Route::get('/{user}', [AccountAdminController::class, 'show'])->name('admin.account.show');
        Route::delete('/{user}', [AccountAdminController::class, 'destroy'])->name('admin.account.destroy');
    });
    
    Route::resource('organization', OrganizationAdminController::class, ['as' => 'admin'])->except(['create', 'store']);
    Route::resource('donor', DonorAdminController::class, ['as' => 'admin'])->only(['index', 'show','destroy']);
});

Route::middleware(['auth','verified','organization'])->prefix('organisasi')->group(function () {
    
    Route::middleware(['verified_organization'])->group(function () {
        Route::get('/', [DashboardOrganizationController::class, 'index'])->name('organization');

        Route::resource('program', ProgramOrganizationController::class, ['as' => 'organization']);

        Route::get('/withdraw', [WithdrawOrganizationController::class, 'index'])->name('organization.withdraw.index');
        Route::get('/withdraw/create', [WithdrawOrganizationController::class, 'create'])->name('organization.withdraw.create');
        Route::post('/withdraw/submission', [WithdrawOrganizationController::class, 'submission'])->name('organization.withdraw.submission');        
    });
    
    Route::get('/profile', [ProfileOrganizationController::class, 'profile'])->name('organization.profile');
    Route::put('/profile/{organization}', [ProfileOrganizationController::class, 'update'])->name('organization.profile.update');

});