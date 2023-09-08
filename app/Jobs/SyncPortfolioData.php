<?php

namespace App\Jobs;

use App\Http\Services\BrokerService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncPortfolioData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $portfolio_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($portfolio_id)
    {
        $this->portfolio_id = $portfolio_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $brokerService = new BrokerService();

            $brokerService->portfolioSync($this->portfolio_id);
            $brokerService->portfolioPercentage($this->portfolio_id);
            $brokerService->profitLoss($this->portfolio_id);

        } catch (Exception $e) {
            app('log')->error('Sync Portfolio Data error with: ' . $this->portfolio_id, [
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);
        }
    }
}
