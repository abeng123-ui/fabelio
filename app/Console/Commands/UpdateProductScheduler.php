<?php

namespace App\Console\Commands;

use App\Http\Controllers\FabelioController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Interfaces\ProductInterface;
use App\Interfaces\ProductPhotoInterface;
use App\Interfaces\ProductPriceHistoryInterface;
use Illuminate\Support\Facades\Log;

class UpdateProductScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-product-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product info based on url product hourly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Start Running Scheduler');
        $result = app('App\Http\Controllers\LinkController')->update_product_scheduler();
        Log::info('End Scheduler');
    }
}
