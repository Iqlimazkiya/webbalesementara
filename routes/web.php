<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LayananCOController;
use App\Http\Controllers\LayananWOController;
use App\Http\Controllers\LayananCAController;
use App\Http\Controllers\LayananDIController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingRedirectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminHomepageController;
use App\Http\Controllers\Admin\UnitController as AdminUnitController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\LayananCOController as AdminLayananCOController;
use App\Http\Controllers\Admin\LayananWOController as AdminLayananWOController;
use App\Http\Controllers\Admin\LayananDIController as AdminLayananDIController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'store'])->name('home.store');

Route::get('/layanan-co', [LayananCOController::class, 'index'])->name('layanan.co');
Route::get('/tipe-unit', [UnitController::class, 'index'])->name('user.tipeunit');
Route::get('/layanan-wo', [LayananWOController::class, 'index'])->name('layanan.wo');
Route::get('/layanan-di', [LayananDIController::class, 'index'])->name('layanan.di');
Route::get('/booking-redirect', [BookingRedirectController::class, 'redirect'])->name('booking.redirect');
Route::get('/contact-redirect', [BookingRedirectController::class, 'contactRedirect'])->name('contact.redirect');
Route::get('/layanan-ca', [LayananCAController::class, 'index'])->name('layanan.ca');
 
// Auth User
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Homepage Control
Route::prefix('home')->name('home.')->group(function () {

    Route::get('/', [AdminHomepageController::class, 'index'])->name('index');

    Route::get('/edit', [AdminHomepageController::class, 'edit'])->name('edit');

    Route::put('/update', [AdminHomepageController::class, 'update'])->name('update');

    Route::post('/preview', [AdminHomepageController::class, 'preview'])->name('preview');

});
    
    // Units
    Route::resource('unit', AdminUnitController::class);
    Route::get('/unit-page/edit', [AdminUnitController::class, 'editPage'])->name('unit-page.edit');
    Route::put('/unit-page/update', [AdminUnitController::class, 'updatePage'])->name('unit-page.update');
    Route::post('/unit-page/preview', [AdminUnitController::class, 'preview'])->name('unit-page.preview');
    Route::post('/unit-page/preview-settings', [AdminUnitController::class, 'previewPageSettings'])->name('unit-page.preview-settings');
    Route::put('/unit/{id}/move-up', [AdminUnitController::class, 'moveUp'])->name('unit.move-up');
    Route::put('/unit/{id}/move-down', [AdminUnitController::class, 'moveDown'])->name('unit.move-down');

    // Cleaning Order
    Route::prefix('layananco')->name('layananco.')->group(function () {
        Route::get('/',       [AdminLayananCOController::class, 'index'])->name('index');
        Route::get('/edit',   [AdminLayananCOController::class, 'edit'])->name('edit');
        Route::put('/update', [AdminLayananCOController::class, 'update'])->name('update');
        Route::post('/preview', [AdminLayananCOController::class, 'preview'])->name('preview');
    });

    // Working Order
    Route::prefix('layananwo')->name('layananwo.')->group(function () {
        Route::get('/',       [AdminLayananWOController::class, 'index'])->name('index');
        Route::get('/edit',   [AdminLayananWOController::class, 'edit'])->name('edit');
        Route::put('/update', [AdminLayananWOController::class, 'update'])->name('update');
        Route::post('/preview', [AdminLayananWOController::class, 'preview'])->name('preview');
    });

    // Desain Interior
     Route::prefix('layanandi')->name('layanandi.')->group(function () {
        Route::get('/',       [AdminLayananDIController::class, 'index'])->name('index');
        Route::get('/edit',   [AdminLayananDIController::class, 'edit'])->name('edit');
        Route::put('/update', [AdminLayananDIController::class, 'update'])->name('update');
        Route::post('/preview', [AdminLayananDIController::class, 'preview'])->name('preview');
    });

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/{key}', [SettingController::class, 'destroy'])->name('settings.destroy');

    // Activities
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities');

    // Messages
    Route::get('/messages/unread-count', function () {
        return response()->json([
            'count' => \App\Models\ContactMessage::where('is_read', false)->count()
        ]);
    })->name('messages.unread-count'); 
 
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/',          [MessageController::class, 'index'])->name('index');
        Route::get('/{id}',      [MessageController::class, 'show'])->name('show');
        Route::put('/{id}/read', [MessageController::class, 'markAsRead'])->name('read');
        Route::delete('/{id}',   [MessageController::class, 'destroy'])->name('destroy');
    });

    // Profile
    Route::get('/profile',          [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit',     [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/photo',  [AdminProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::delete('/profile/photo', [AdminProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
});

require __DIR__.'/auth.php';