<?php

namespace App\Http\Controllers;


use App\Models\Car;
use App\Models\Key;
use App\Models\User;
use App\Services\FuncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;


class CarController extends Controller
{


    public function drive(User $user, Request $request)
    {


        if ($user->car->fuel < 0.05 && $request->stmt == "drive"){
            abort(403,'you need more fuel');
        }
        FuncService::drive($user, $request->stmt);
        return redirect()->back();
    }


    public function getKey(Key $key)
    {
        FuncService::getKey($key);
        return redirect()->back();
    }

    public function driverListenRadio( User $user)
    {
        FuncService::driverListenRadio($user);
        return redirect()->route('custom.car');
    }

    public function driverUnlocksDoors( User $user)
    {
        FuncService::driverUnlocksDoors($user);
        return redirect()->route('custom.car');
    }
    public function driverLocksDoors(User $user )
    {
        FuncService::driverLocksDoors($user);
        return redirect()->route('custom.car');
    }
    public function driverTurnsCarOn( User $user)
    {
        FuncService::driverTurnsCarOn($user);
        return redirect()->route('custom.car');
    }
    public function driverTurnsCarOff(User $user)
    {
        FuncService::driverTurnsCarOff($user);
        return redirect()->route('custom.car');
    }



    public function driverListenCd(User $user)
    {
        FuncService::driverListenCd($user);
        return redirect()->route('custom.car');
    }
    public function driverListenSpotify(User $user)
    {
        FuncService::driverListenSpotify($user);
        return redirect()->route('custom.car');
    }




    public function addFuel( User $user, Request $request)
    {

        if ($user->car->statement_car == 'drive'){

            abort(403, 'You can`t add fuel, while you drive');
        }

        FuncService::addFuel($user, $request->fuel);

        return redirect()->route('custom.car');
    }

    public function driverRaisesWindows(User $user, Request $request)
    {
        FuncService::driverRaisesWindows($user, $request->place);
        return redirect()->route('custom.car');
    }

    public function driverLowersWindows(User $user, Request $request)
    {
        FuncService::driverLowersWindows($user, $request->place);
        return redirect()->route('custom.car');
    }



}
