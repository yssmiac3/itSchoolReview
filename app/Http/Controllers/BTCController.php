<?php

namespace App\Http\Controllers;

use App\ExternalAPI\Coin;
use Illuminate\Support\Facades\Cache;

class BTCController extends Controller
{
    public function getRate()
    {
        return response()->json(Cache::get('btcRate'), 200);
//        return response()->json((new Coin())->getCertainCoinPrice('BTC'), 200);
    }
}
