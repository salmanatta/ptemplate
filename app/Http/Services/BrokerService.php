<?php

namespace App\Http\Services;

use App\Models\UserDailyWallet;
use App\Models\Stock;
use App\Models\UserWallet;
use App\Http\Services\DerayahApi;
use App\Models\Broker;
use Carbon\Carbon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use JsonException;
use Throwable;

class BrokerService
{
    /**
     * @throws RequestException
     * @throws JsonException
     */
    public function portfolioSync($portfolioId)
    {
        try {
            $startTime = microtime(true);

            $resBody = match (substr($portfolioId, 0, 3)) {
                'DRY' => DerayahApi::setPortfolioId($portfolioId)->getPortfolioSync()->body(),
            };

            $data = $resBody['data'];
        } catch (Throwable $e) {
            app('log')->error('PortfolioSync error with expert '.$portfolioId, [
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);

            return;
        }

        UserWallet::where('portfolio_id', $portfolioId)->delete();
        $stockIds = Arr::pluck($data, 'stockID');

        $stockName = Stock::query()
            ->whereIn('stock_id', $stockIds)
            ->pluck('stock_name', 'stock_id');

        $userWallets = [];

        foreach ($data as $value) {
            if (! $stockName->has($value['stockID'])) {
                app('log')->warning('PortfolioSync missing stock '.$value['stockID'].' for expert '.$portfolioId);
                // TODO: notify admin
                continue;
            }

            $newData = [];
            $newData['portfolio_id'] = $portfolioId;
            $newData['stock_id'] = $value['stockID'];
            $newData['quantity'] = $value['quantity'];
            $newData['avg_buy_price'] = $value['averageBuyPrice'];
            $newData['current_price'] = $value['stockCurrentPrice'];
            $newData['profit_loss'] = $value['currentProfitLoss'];
            $newData['current_value'] = ($value['stockCurrentPrice'] * $value['quantity']);
            $newData['invested'] = $value['cost'];
            $newData['wallet_per'] = round($value['stockPrtfolioPercentage'], 2);
            $newData['stock_name'] = $stockName->get($value['stockID']);
            // $newData['buy_date'] = $lastBuy->get($value['stockID']);

            if (0 !== (int) $value['stockCurrentPrice'] && 0 !== (int) $value['cost']) {
                $newData['profit_per'] = round($value['currentProfitLoss'] / $value['cost'] * 100, 2);
            } else {
                $newData['profit_per'] = 0;
            }

            UserWallet::create($newData);
            $userWallets[] = $newData;
        }

        $dailyWallet = UserDailyWallet::where('portfolio_id', $portfolioId)->whereDate('created_at', Carbon::today())->first();

        if (! $dailyWallet) {
            $dailyWallet = new UserDailyWallet();
            $dailyWallet->portfolio_id = $portfolioId;
            $lastDailyWalletCurrentValue = UserDailyWallet::query()
                ->where('portfolio_id', $portfolioId)
                ->whereDate('created_at', '<>', today())
                ->latest('created_at')
                ->value('current_value');

            $dailyWallet->total_cost = $lastDailyWalletCurrentValue ?? null;
        }

        $dailyWallet->stocks = count($userWallets);
        $dailyWallet->save();

        $end = microtime(true);
        $time = number_format(($end - $startTime), 2);

        app('log')->info('portfolioSyncTime: '.$portfolioId.'-'.$time);

        return $resBody;
    }

    /**
     * @throws RequestException
     * @throws JsonException
     */
    public function portfolioPercentage($portfolioId)
    {
        try {
            $startTime = microtime(true);

            $resBody = match (substr($portfolioId, 0, 3)) {
                'DRY' => DerayahApi::setPortfolioId($portfolioId)->getPortfolioPercentage()->body(),
            };

            $data = $resBody['data'];
        } catch (Throwable $e) {
            app('log')->error('portfolioPercentage error with expert '.$portfolioId, [
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);

            return;
        }

        $portfolioPer = UserDailyWallet::query()
            ->where('portfolio_id', $portfolioId)
            ->whereDate('created_at', today())
            ->first();

        if (! $portfolioPer) {
            $portfolioPer = new UserDailyWallet();
            $portfolioPer->portfolio_id = $portfolioId;

            $lastDailyWalletCurrentValue = UserDailyWallet::query()
                ->where('portfolio_id', $portfolioId)
                ->whereDate('created_at', '<>', today())
                ->latest('created_at')
                ->value('current_value');

            $portfolioPer->total_cost = $portfolioPer->total_cost ?? $lastDailyWalletCurrentValue;
        }

        $portfolioPer->stockPercent = round($data['stockPercent'] * 100, 2);
        $portfolioPer->cash = round($data['cashPercent'] * 100, 2);
        $portfolioPer->loan = round($data['leveragePercent'] * 100, 2);
        $portfolioPer->fund = round($data['fundPercent'] * 100, 2);
        $portfolioPer->future = round($data['futurePercent'] * 100, 2);
        $portfolioPer->sukok = round($data['sukokPercent'] * 100, 2);
        $portfolioPer->save();

        $end = microtime(true);
        $time = number_format(($end - $startTime), 2);

        app('log')->info('portfolioPercentageTime: '.$portfolioId.'-'.$time);

        return $resBody;
    }

    /**
     * @throws RequestException
     * @throws JsonException
     */
    public function profitLoss($portfolioId)
    {
        try {
            $startTime = microtime(true);

            $resBody = match (substr($portfolioId, 0, 3)) {
                'DRY' => DerayahApi::setPortfolioId($portfolioId)->getProfitLoss()->body(),
            };

            $data = $resBody['data'];
        } catch (Throwable $e) {
            app('log')->error('profitLoss error with expert '.$portfolioId, [
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);

            return;
        }

        $dailyWallet = UserDailyWallet::query()
            ->where('portfolio_id', $portfolioId)
            ->whereDate('created_at', today())
            ->first();

        if (null === $dailyWallet) {
            return;
        }

        if ($data['currentValue'] == 0) {
            $dataLogs = ['dataDRY' => $data, 'portfolio_id' => $portfolioId, 'dailyWallet' => $dailyWallet];
            app('log')->error('currentValue calculation issue '.$portfolioId, [
                'data' => $dataLogs,

            ]);
            // NotificationHelper::notifyUserByRoles('profitLoss with portfolioid   '.$portfolioId.' has current value as 0 and is being skipped', ['Super Admin']);

            return;
        } else {
            $currentValue = $data['currentValue'] * (1 + ($dailyWallet->loan / 100));

            if (0 !== (int) $dailyWallet->fund) {
                $currentValue += (($data['currentValue'] * (1 + ($dailyWallet->loan / 100)) * ($dailyWallet->fund / 100)) / (1 - ($dailyWallet->fund / 100)));
            }
            if (0 !== (int) $dailyWallet->sukok) {
                $currentValue += (($data['currentValue'] * (1 + ($dailyWallet->loan / 100)) * ($dailyWallet->sukok / 100)) / (1 - ($dailyWallet->sukok / 100)));
            }
            if (0 !== (int) $dailyWallet->future) {
                $currentValue += (($data['currentValue'] * (1 + ($dailyWallet->loan / 100)) * ($dailyWallet->future / 100)) / (1 - ($dailyWallet->future / 100)));
            }

            $dailyWallet->cash_power = $currentValue * ($dailyWallet->cash / 100);
        }


        if (! $dailyWallet->total_cost) {
            $dailyWallet->total_cost = $currentValue;
        }

        $totalCost = $dailyWallet->total_cost;
        $dailyWallet->current_value = $currentValue;
        $dailyWallet->profit_loss = $currentValue - $totalCost;
        $dailyWallet->profit_loss_per = round($dailyWallet->profit_loss / $totalCost * 100, 2);
        $dailyWallet->save();

        $end = microtime(true);
        $time = number_format(($end - $startTime), 2);

        app('log')->info('profitLossTime: '.$portfolioId.'-'.$time);

        return $resBody;
    }

    public function activatePortfolio($portfolioId, $brokerId)
    {
        try {
            $broker = Broker::find($brokerId);

            $data = match ($broker->code) {
                'DRY' => DerayahApi::setPortfolioId($portfolioId)->activatePortfolio()->body(),
            };

            // set message attribute if not set
            if (! isset($data['message'])) {
                $data['message'] = $data['errorMsg'];
            }

            if ($data['data'] == 4) {
                $result = [
                    'errorCode' => '0',
                    'errorMsg' => $data['message'],
                    'data' => $data['data'],
                ];
            } else {
                $result = [
                    'errorCode' => '1',
                    'errorMsg' => $data['message'],
                    'data' => $data['data'],
                ];
            }

            return $result;
        } catch (Throwable $e) {
            app('log')->error('activatePortfolio error with expert '.$portfolioId, [
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);

            return ['errorCode' => '-1', 'errorMsg' => $e->getMessage(), 'data' => []];
        }
    }

    public function confirmActivatePortfolio($portfolioId, $otp, $brokerId)
    {
        try {
            $broker = Broker::find($brokerId);

            $body = match ($broker->code) {
                'DRY' => DerayahApi::setPortfolioId($portfolioId)->confirmActivatePortfolio($otp)->body(),
            };

            // set message attribute if not set
            if (! array_key_exists('message', $body->toArray())) {
                $body['message'] = array_key_exists('errorMsg', $body->toArray()) ? $body['errorMsg'] : '';
            }

            if (false == $body['isSuccess']) {
                $result = [
                    'errorCode' => '1',
                    'errorMsg' => $body['message'],
                    'data' => [],
                ];
            } else {
                $result = [
                    'errorCode' => '0',
                    'errorMsg' => $body['message'],
                    'data' => $body['data'],
                ];
            }

            return json_encode($result);
        } catch (Throwable $e) {
            app('log')->error('confirmActivatePortfolio error with expert '.$portfolioId, [
                'Message' => $e->getMessage(),
                'body' => isset($body) ? $body->toArray() : null,
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);

            return json_encode(['errorCode' => '-1', 'errorMsg' => $e->getMessage(), 'data' => []]);
        }
    }
}
