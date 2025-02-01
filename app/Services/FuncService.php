<?php

namespace App\Services;

use App\Models\Key;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class FuncService
{


    public static function drive(User $user, string $stmt)
    {
        $stmt = strtr($stmt, ['"' => '']);

        if ($stmt == "drive"){

            if ($user->car->isTurn && $user->car->fuel >= 0.05){

                $user->car->statement_car = $stmt;
                $user->car->speed = min(160, $user->car->speed + 40);
                $user->car->odometer += $user->car->speed;
                $user->car->fuel -= 0.05;

            }
            else{
                abort(403, 'Your fuel less, than 0.05');
            }
        }

        if ($stmt == "stop"){
            $user->car->odometer = 0;
            $user->car->speed = 0;
            $user->car->statement_car = $stmt;
        }

        $user->car->save();

    }



    public static function getKey(Key $key)
    {

        if ($key->is_have == 1){

            $key->is_have = 0;
        }
        else{

            $key->is_have = 1;
        }
        $key->save();
    }

    public static function driverListenRadio( User $user, bool $unlock = null)
    {



        if ($user->car->isTurn = 1){

            if ($user->car->entertainment_Unit == "radio"){
                $user->car->entertainment_Unit = 0;
            }
            else{
                $user->car->entertainment_Unit = "radio";
            }


            if (is_bool($unlock)){
                if ($unlock == 1){
                    $user->car->entertainment_Unit = 'radio';
                }
                else{
                    $user->car->entertainment_Unit = 0;
                }
            }
            $user->car->save();
        }

    }
    public static function driverListenCd(User $user,bool $unlock = null)
    {

        if ($user->car->isTurn = 1){

            if ($user->car->entertainment_Unit == "Cd"){
                $user->car->entertainment_Unit = 0;
            }
            else{
                $user->car->entertainment_Unit = "Cd";
            }


            if (is_bool($unlock)){
                if ($unlock == 1){
                    $user->car->entertainment_Unit = 'Cd';
                }
                else{
                    $user->car->entertainment_Unit = 0;
                }
            }
            $user->car->save();
        }
    }
    public static function driverListenSpotify( User $user, bool $unlock = null)
    {
        if ($user->car->isTurn = 1){

            if ($user->car->entertainment_Unit == "Spotify"){
                $user->car->entertainment_Unit = 0;
            }
            else{
                $user->car->entertainment_Unit = "Spotify";
            }


            if (is_bool($unlock)){
                if ($unlock == 1){
                    $user->car->entertainment_Unit = 'Spotify';
                }
                else{
                    $user->car->entertainment_Unit = 0;
                }
            }
            $user->car->save();
        }
    }

    public static function driverUnlocksDoors( User $user, bool $unlock = null )
    {
        if ($user->throughKey->is_have == 1){
            $user->car->isOpenDoor = $unlock ?? 1;
            $user->car->save();
        }

    }
    public static function driverLocksDoors(User $user , bool $unlock = null)
    {
        if (!empty($unlock)){
            $unlock = !$unlock;
        }
        if ($user->throughKey->is_have == 1){
            $user->car->isOpenDoor = $unlock ?? 0;
            $user->car->save();
        }

    }
    public static function driverTurnsCarOn( User $user, bool $on = null)
    {
        if ($user->throughKey->is_have == 1 ){
            $user->car->isTurn = $on ?? 1;
            $user->car->save();
        }

    }
    public static function driverTurnsCarOff(User $user, bool $off = null)
    {
        if (!empty($off)){
            $off = !$off;
        }
        if ($user->throughKey->is_have == 1){
            $user->car->isTurn = $off ?? 0;
            $user->car->statement_car = 'stop';
            $user->car->save();
        }

    }

    public static function addFuel( User $user, float $litres = null)
    {

        if ($user->car->statement_car == 'stop'){

            $user->car->fuel = min(1, $user->car->fuel + $litres);
            $user->car->save();
        }

    }

    public static function driverRaisesWindows( User $user, string $place = null, )
    {
        if ($place == "left" && $user->car->leftWindow < 100){
            $user->car->leftWindow = (int) $user->car->leftWindow + 50;
            $user->car->save();
        }
        if ($place == "right" && $user->car->leftWindow < 100){
            $user->car->rightWindow = (int) $user->car->rightWindow + 50;
            $user->car->save();
        }

    }

    public static function driverLowersWindows(User $user, string $place = null)
    {
        if ($place == "left" && $user->car->leftWindow > 0){
            $user->car->leftWindow = (int) $user->car->leftWindow - 50;
            $user->car->save();
        }
        if ($place == "right" && $user->car->rightWindow > 0){
            $user->car->rightWindow = (int) $user->car->rightWindow - 50;
            $user->car->save();
        }

    }
}
