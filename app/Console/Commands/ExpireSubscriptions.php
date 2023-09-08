<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will check all the subscriptions and expire them if dates are not valid';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriptions = Subscription::whereIsActive(true)->whereIsConfirmed(true)->get();
        foreach ($subscriptions as $subscription) {
            if ($subscription->start_date <= date('Y-m-d') && $subscription->end_date > date('Y-m-d')) {
                $subscription->is_active = false;
                $subscription->save();
            }
        }
        return Command::SUCCESS;
    }
}
