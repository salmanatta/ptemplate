<?php

namespace App\Console\Commands;

use App\Models\MarketType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MarketTypeScrapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will get the market types from dawul and load in tharee';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $connection_2 = DB::connection('mysql2');
        $markets = $connection_2->select('select * from market_types');
        foreach($markets as $obj)
        {
            $market = MarketType::whereMarketCode($obj->market_code)->first();
            if (! $market) {
                $market = new MarketType();
            }
            $market->market_code = $obj->market_code;
            $market->market_name_ar = $obj->market_name_ar;
            $market->market_name_en = $obj->market_name_en;
            $market->market_currency_en = $obj->market_currency_en;
            $market->market_currency_ar = $obj->market_currency_ar;
            $market->in_stocks_code = $obj->in_stocks_code;
            $market->exchange_rate = $obj->exchange_rate;
            $market->exchange_rate_old = $obj->exchange_rate_old;
            $market->save();
        }
        return Command::SUCCESS;
    }
}
