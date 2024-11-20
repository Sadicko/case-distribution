<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\CourtJudgeController;
use App\Http\Controllers\CourttypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/dashboard');


// Route::get('/', function () {
//     return view('front-end.welcome');
// })->middleware(['auth']);

Route::middleware(['auth', 'auth.reset-password'])->group(function () {
    // home
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    //Route::get('/workflow', [HomeController::class, 'showWorkflow'])->name('workflow');
    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    //assets
    Route::get('/assets', [ AssetController::class, 'showAssets'])->name('assets');
    Route::get('/assets/create', [ AssetController::class, 'createAsset'])->name('assets.create');
    Route::post('/assets/create', [ AssetController::class, 'saveAsset'])->name('assets.create');
    Route::get('/assets/{slug}/show', [ AssetController::class, 'showAsset'])->name('assets.show');
    Route::get('/assets/{slug}/edit', [ AssetController::class, 'showEdit'])->name('assets.edit');
    Route::post('/assets/{slug}/edit', [ AssetController::class, 'updateAsset'])->name('assets.edit');

    // reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports');

    // courttypes
    Route::resource('courttypes', CourttypeController::class);

    // location
    Route::get('/locations', [LocationController::class, 'index'])->name('locations');
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations/create', [LocationController::class, 'store'])->name('locations.create');
    Route::get('/locations/{slug}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::post('/locations/{slug}/edit', [LocationController::class, 'update'])->name('locations.edit');
    Route::post('/locations/fetch', [LocationController::class, 'fetchLocations']);

    // registries settings
    Route::get('/registries', [RegistryController::class, 'index'])->name('registries');
    Route::get('/registries/create', [RegistryController::class, 'create'])->name('registries.create');
    Route::post('/registries/create', [RegistryController::class, 'store'])->name('registries.create');
    Route::get('/registries/{slug}/edit', [RegistryController::class, 'edit'])->name('registries.edit');
    Route::post('/registries/{slug}/edit', [RegistryController::class, 'update'])->name('registries.edit');
    Route::post('/registry/fetch', [RegistryController::class, 'fetchRegistry']);

    // courts
    Route::get('/courts', [CourtController::class, 'index'])->name('courts');
    Route::get('/courts/create', [CourtController::class, 'create'])->name('courts.create');
    Route::post('/courts/create', [CourtController::class, 'store'])->name('courts.create');
    Route::get('/courts/{slug}/edit', [CourtController::class, 'edit'])->name('courts.edit');
    Route::post('/courts/{slug}/edit', [CourtController::class, 'update'])->name('courts.edit');

    // judges
    Route::get('/judges', [JudgeController::class, 'index'])->name('judges');
    Route::get('/judges/create', [JudgeController::class, 'create'])->name('judges.create');
    Route::post('/judges/create', [JudgeController::class, 'store'])->name('judges.create');
    Route::get('/judges/{slug}/edit', [JudgeController::class, 'edit'])->name('judges.edit');
    Route::post('/judges/{slug}/edit', [JudgeController::class, 'update'])->name('judges.edit');

    //court-judge assigment
    Route::get('/court-judge/{slug}/assign', [CourtJudgeController::class, 'index'])->name('court-judge');
    Route::post('/court-judge/{slug}/assign', [CourtJudgeController::class, 'assignJudge'])->name('court-judge');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // logs
    Route::get('system-logs', [LogController::class, 'index'])->name('logs');

    // admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // roles
    Route::get('/admin/roles', [RolesController::class, 'index'])->name('admin.roles');
    Route::get('/admin/roles/create/{slug?}', [RolesController::class, 'create'])->name('admin.roles.create');
    Route::post('/admin/roles/create/{slug?}', [RolesController::class, 'store'])->name('admin.roles.create');
    Route::get('/admin/roles/{slug}/assign-permissions', [RolesController::class, 'showAssignPermissionsPage'])->name('admin.roles.assign');
    Route::post('/admin/roles/{slug}/assign-permissions', [RolesController::class, 'assignPermissions'])->name('admin.roles.assign');
    // users
    Route::get('/admin/system-users', [UserController::class, 'showUsers'])->name('admin.users');
    Route::get('/admin/system-users/create', [UserController::class, 'showCreateUserPage'])->name('admin.users.create');
    Route::post('/admin/system-users/create', [UserController::class, 'saveUser'])->name('admin.users.create');
    Route::get('/admin/system-users/{slug}/edit', [UserController::class, 'showEditUserPage'])->name('admin.users.edit');
    Route::post('/admin/system-users/{slug}/edit', [UserController::class, 'updateUser'])->name('admin.users.edit');

//    Route::get('/admin/messages', [AdminController::class, 'showMessages'])->name('admin.messages');
//    Route::get('/admin/messages/{slug}/show', [AdminController::class, 'messageDetails'])->name('admin.messages.show');

    //backup
    Route::get('/admin/backups', [BackupController::class, 'index'])->name('admin.backups');
    Route::get('/admin/backups/{file_name}/download', [BackupController::class, 'download'])->name('admin.backups.download');
});

require __DIR__ . '/auth.php';



Route::fallback(function () {
    return abort(404);
});
