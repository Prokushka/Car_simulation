<?php

use App\Http\Controllers\CarController;

use App\Models\User;

use App\Services\StartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('index');
});
Route::get('/console', function (StartService $service){
    $service->file(new \App\Services\CallFuncService(), 'part1.csv');
});
Route::get('/custom_car', function (StartService $service){
    $service->create();
    $user = User::query()->first();
    if (Auth::attempt([
        'email' => $user->email,
        'password' => $user->password,
    ])){

        \request()->session()->regenerate();
    }
    return view('car', ['user' => $user]);
})->name('custom.car');

Route::patch('/car/getKey/{key}', [CarController::class, 'getKey'])->name('get.key');
Route::patch('/car/UnlockDoors/{user}', [CarController::class, 'driverUnlocksDoors'])->name('open.door');
Route::patch('/car/LockDoors/{user}', [CarController::class, 'driverLocksDoors'])->name('close.door');
Route::patch('/car/TurnCar/{user}', [CarController::class, 'driverTurnsCarOn'])->name('turn.car');
Route::patch('/car/SleepCar/{user}', [CarController::class, 'driverTurnsCarOff'])->name('sleep.car');

Route::patch('/car/RaisesWindow/{user}', [CarController::class, 'driverRaisesWindows'])->name('raises.window');
Route::patch('/car/LowerWindow/{user}', [CarController::class, 'driverLowersWindows'])->name('lower.window');

Route::patch('/car/ListenRadio/{user}', [CarController::class, 'driverListenRadio'])->name('listen.radio');
Route::patch('/car/ListenCd/{user}', [CarController::class, 'driverListenCd'])->name('listen.cd');
Route::patch('/car/ListenSpotify/{user}', [CarController::class, 'driverListenSpotify'])->name('listen.spotify');

Route::patch('/car/addFuel/{user}', [CarController::class, 'addFuel'])->name('add.fuel');

Route::patch('/car/drive/{user}', [CarController::class, 'drive'])->name('drive');
Route::patch('/car/stop/{user}', [CarController::class, 'drive'])->name('stop');
