<?php

namespace App\Console\Commands;

use App\ExternalAPI\Coin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GetBTCRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:getBTC';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get BTC current rate with external API and put to cache';

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
     * @return int
     */
    public function handle()
    {
        $rate = (new Coin())->getCertainCoinPrice('BTC');
        Cache::put('btcRate', $rate);
        return 0;
    }
}
