<?php

namespace App\Console\Commands;

use App\Models\Stock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StockScrapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will get data from dawul database and store in Tharee';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $connection_2 = DB::connection('mysql2');
        $stocks = $connection_2->select('select * from stocks');
        foreach($stocks as $obj)
        {
            $stock = Stock::whereStockId($obj->stock_id)->first();
            if (! $stock) {
                $stock = new Stock();
            }
            $stock->stock_id = $obj->stock_id;
            $stock->stock_arabic_name = $obj->stock_arabic_name;
            $stock->stock_name = $obj->stock_name;
            $stock->image = $obj->image;
            $stock->sector = $obj->sector;
            $stock->is_active = $obj->is_active;
            $stock->stock_risk_factor = $obj->stock_risk_factor;
            $stock->market_type = $obj->market_type;
            $stock->abdulaziz_alfawzan = $obj->abdulaziz_alfawzan;
            $stock->mohammed_alaseemy = $obj->mohammed_alaseemy;
            $stock->alinma_investment = $obj->alinma_investment;
            $stock->albilad_capital = $obj->albilad_capital;
            $stock->alrajhi_capital = $obj->alrajhi_capital;
            $stock->bio_en = $obj->bio_en;
            $stock->bio_ar = $obj->bio_ar;
            $stock->latest_price = $obj->latest_price;
            $stock->save();
        }


        return Command::SUCCESS;
    }
}
