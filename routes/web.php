 <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ACController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\LightController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\RoomACController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\ScheduleController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\EmissionsController;
    use App\Http\Controllers\RoomLightController;
    use App\Http\Controllers\AppliancesController;
    use App\Http\Controllers\AppliencesController;
    use App\Http\Controllers\UsageByRoomController;
use App\Models\Appliances;

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


    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.tes');


    //middleware routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/picture', [ProfileController::class, 'updatePic'])->name('profile.picture');
        Route::get('/profile/delete', [ProfileController::class, 'pictureDel'])->name('profile.delete');

        Route::get('/appliences', [AppliancesController::class, 'index'])->name('appliences');
        Route::get('/usage_by_room', [UsageByRoomController::class, 'index'])->name('usage_by_room');
        Route::get('/emissions', [EmissionsController::class, 'index'])->name('emissions');
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/room_light', [RoomLightController::class, 'index'])->name('room_light');
        Route::get('/light', [LightController::class, 'index'])->name('light');
        Route::get('/room_ac', [RoomACController::class, 'index'])->name('room_ac');
        Route::get('/ac', [ACController::class, 'index'])->name('ac');
        Route::get('/light', [LightController::class, 'index'])->name('light');

        Route::get('/schedule/add', [ScheduleController::class, 'index'])->name('schedule.add');
        Route::post('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');

        Route::get('/schedule/edit/{id}', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::patch('/schedule/edit/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/schedule/delete/{id}', [ScheduleController::class, 'destroy'])->name('schedule.delete');


        Route::patch('/appliances/{id}/status', [AppliancesController::class, 'status'])->name('appliances.status');
        Route::patch('/appliances/AC/{id}/speed-fan', [ACController::class, 'speed'])->name('ac.speed');

        Route::patch('/ac/degree/{id}', [ACController::class, 'degree'])->name('ac.degree');

        Route::patch('/light/lux/{id}', [LightController::class, 'lux'])->name('light.lux');

        Route::get('/report/add', [ReportController::class, 'showAdd'])->name('report.add');
        Route::get('/report/view-{id}', [ReportController::class, 'view'])->name('report.view');
        Route::post('/report/create', [ReportController::class, 'create'])->name('report.create');
        Route::get('/report/download-{id}', [reportController::class, 'downloadPdf'])->name('report.download');
        Route::delete('/report/delete/{id}', [ReportController::class, 'destroy'])->name('report.delete');

        Route::post('/lampu/{id}/update-usage', [RoomLightController::class, 'updateUsage']);
        Route::post('/ac/{id}/update-usage', [RoomACController::class, 'updateUsage']);

        Route::get('/appliances/resetDataApp', [AppliancesController::class, 'resetDataApp']);
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
