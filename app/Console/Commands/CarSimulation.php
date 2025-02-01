<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\CallFuncService;
use App\Services\StartService;

use Illuminate\Console\Command;
use Illuminate\Http\Request;


class CarSimulation extends Command
{
    protected $signature = 'car:simulate';
    protected $description = 'Simulate car events from a CSV file';

    public function handle(StartService $service)
    {
        if ($this->confirm('have you a key?')){
            $fileName = $this->choice('How file you would open?',
            [
                'part1.csv', 'part2.csv'
            ],
            'part1.csv');
            $service->create();
            $service->file(new CallFuncService(), $fileName);
            $this->call('car:info');
        }
        else{
            if ($this->confirm('Would you have a key?', true)){
                $this->call('car:key');
                $this->call('car:simulate');
            }else{

                $this->error('please, write: php artisan car:key');
            }

        }







    }


}
