<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Info extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::query()->first();
        $this->newLine(3);
        $this->info('Car status: ' . $user->car->statement_car);
        $this->info('Speed: ' . $user->car->speed . ' km/h');
        $this->info('Odometer: ' . $user->car->odometer . ' km');
        $this->info('Fuel Level: ' . $user->car->fuel . ' L');
        $this->info('Car is Turn: ' . ($user->car->is_Turn ? 'Yes' : 'No'));
        $this->info('Doors Open: ' . ($user->car->isOpenDoor ? 'Yes' : 'No'));
        $this->info('Entertainment Mode: ' . $user->car->entertainment_Unit);
        $this->info('Left Window: ' . $user->car->leftWindow . '%');
        $this->info('Right Window: ' . $user->car->rightWindow . '%');
    }
}
