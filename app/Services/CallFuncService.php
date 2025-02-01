<?php

namespace App\Services;

use App\Http\Controllers\CarController;
use App\Models\Car;
use App\Models\Key;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CallFuncService
{


    public function __invoke(FuncService $funcService, User $user, $filename)
    {



        $command = [];
        $file = file(Storage::path($filename));

        $arr = array_map('str_getcsv', $file);

        foreach ($arr as $item => $value){

            $command[$item] = array($value[0] => $value[1]);

        }

        for ($i = 0; $i < count($command); $i++){

            $func = lcfirst(strtr(ucwords(key($command[$i]), '-') , ['-' => '']));

            if (method_exists($funcService, $func)){
                $funcService->{$func}( $user, trim(end($command[$i])));
            }
        }


    }
}
