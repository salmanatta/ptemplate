<?php

namespace App\Console\Commands;

use App\Models\Fund;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FundScrapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:fund';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will scrap the funds from dawul and store in tharee';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $connection_2 = DB::connection('mysql2');
        $funds = $connection_2->select('select * from funds');
        foreach($funds as $obj)
        {
            $fund = Fund::whereFundId($obj->fund_id)->first();
            if (! $fund) {
                $fund = new Fund();
            }
            $fund->fund_id = $obj->fund_id;
            $fund->manager_ar = $obj->manager_ar;
            $fund->manager_en = $obj->manager_en;
            $fund->name_en = $obj->name_en;
            $fund->name_ar = $obj->name_ar;
            $fund->short_name_ar = $obj->short_name_ar;
            $fund->short_name_en = $obj->short_name_en;
            $fund->objective = $obj->objective;
            $fund->category_ar = $obj->category_ar;
            $fund->category_en = $obj->category_en;
            $fund->goals_ar = $obj->goals_ar;
            $fund->goals_en = $obj->goals_en;
            $fund->sharia_compliant = $obj->sharia_compliant;
            $fund->logo = $obj->logo;
            $fund->compare_index_ar = $obj->compare_index_ar;
            $fund->compare_index_en = $obj->compare_index_en;
            $fund->inception_date = $obj->inception_date;
            $fund->inception_price = $obj->inception_price;
            $fund->currency = $obj->currency;
            $fund->investment_percent = $obj->investment_percent;
            $fund->profit = $obj->profit;
            $fund->risk = $obj->risk;
            $fund->duration = $obj->duration;
            $fund->index = $obj->index;
            $fund->ratio = $obj->ratio;
            $fund->aum = $obj->aum;
            $fund->valuation_date = $obj->valuation_date;
            $fund->valuation_days_ar = $obj->valuation_days_ar;
            $fund->valuation_days_en = $obj->valuation_days_en;
            $fund->announcement_days_ar = $obj->announcement_days_ar;
            $fund->announcement_days_en = $obj->announcement_days_en;
            $fund->nav_per_unit = $obj->nav_per_unit;
            $fund->show = $obj->show;
            $fund->minimum_subscription = $obj->minimum_subscription;
            $fund->save();
        }
        return Command::SUCCESS;
    }
}
