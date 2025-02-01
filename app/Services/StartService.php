<?php

namespace App\Services;
use App\Models\Car;
use App\Models\Key;
use App\Models\User;
use App\Services\CallFuncService;
use App\Services\FuncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartService
{
    public function create()
    {
        $auth = [
            'name' => fake()->name,
            'email' => fake()->unique()->email,
            'password' => fake()->password
        ];

        $user = User::query()->firstOrCreate(
            User::query()->first() ? User::query()->first()->only('password', 'email', 'name') : $auth
        );

        $car = Car::query()->firstOrCreate([
            'user_id' => $user->id,
        ]);
        Key::query()->firstOrCreate([
            'car_id' =>  $car->id
        ]);



    }
    public function file(CallFuncService $service, $filename)
    {
        $user = User::query()->first();

        $service(new FuncService(), $user, $filename);
    }
}
