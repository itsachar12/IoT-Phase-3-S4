 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppliencesController;
use App\Http\Controllers\UsageByRoomController;
use App\Http\Controllers\EmissionsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomLightController;
use App\Http\Controllers\RoomACController;
use App\Http\Controllers\ACController;
use App\Http\Controllers\LightController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.tes');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/appliences', [AppliencesController::class, 'index'])->name('appliences');

Route::get('/usage_by_room', [UsageByRoomController::class, 'index'])->name('usage_by_room');

Route::get('/emissions', [EmissionsController::class, 'index'])->name('emissions');

Route::get('/report', [ReportController::class, 'index'])->name('report.index');


Route::get('/room_light', [RoomLightController::class, 'index'])->name('room_light');

Route::get('/light', [LightController::class, 'index'])->name('light');

Route::get('/room_ac', [RoomACController::class, 'index'])->name('room_ac');

Route::get('/ac', [ACController::class, 'index'])->name('ac');

Route::get('/light', [LightController::class, 'index'])->name('light');



