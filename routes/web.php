<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\FCMNotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware(['auth']);

Route::get('/home', function () {
    return view('index');
})->middleware(['auth']);

Route::middleware(['auth'])->prefix('profile')->group(function() {
    Route::get('/{id?}', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcement.index');
Route::post('/announcements', [AnnouncementController::class, 'index']);

Route::get('/create-token', function(Request $request) {
    $user = User::find(Auth::id());

    $user->update([
        'device_token' => $request->token
    ]);
})->name('save-token');

Route::get('/fcm', [FCMNotificationController::class, 'notification'])->name('fcm.send');





require __DIR__.'/auth.php';
