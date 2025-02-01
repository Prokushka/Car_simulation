<?php

namespace App\Console\Commands;

use App\Http\Controllers\StartController;
use App\Models\Key;
use App\Services\FuncService;
use Illuminate\Console\Command;

class GetKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start car';

    /**
     * Execute the console command.
     */
    public function handle(FuncService $func)
    {
        $key = Key::query()->firstOrCreate([
            'car_id' => 1

        ]);
        $func->getKey($key);
        $this->info('Give you a key from your car...');
        $this->info('if you want lost key, just repeat this command');


    }
}
