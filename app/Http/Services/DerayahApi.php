<?php

namespace App\Http\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\Pure;
use JsonException;

class DerayahApi
{
    protected array $response;

    protected string|int $portfolioId;

    protected string $base_url = 'https://api.derayah.com';

    public function __construct()
    {
        if (config('services.derayah.derayah_host')) {
            $this->base_url = config('services.derayah.derayah_host');
        }
    }

    /**
     * @throws RequestException
     * @throws JsonException
     */
    public function getToken(): string
    {
        $token = Cache::get('derayah_token');
        $token = null;

        if (is_null($token)) {
            $url = $this->base_url . '/identity/gettoken';

            $response = Http::asForm()
                ->retry(3, 1500)
                ->post($url, [
                    'client_id' => config('services.derayah.client_id'),
                    'client_secret' => config('services.derayah.client_secret'),
                    'scope' => config('services.derayah.scope'),
                    'grant_type' => config('services.derayah.grant_type'),
                ])
                ->throw()
                ->body();

            $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

            $token = $response['access_token'];

            Cache::put('derayah_token', $response['access_token'], $response['expires_in']);
        }

        return $token;
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    public function getPortfolioSync(): self
    {
        $url = $this->base_url . '/dawul/PortfolioSync';

        return $this->sendRequest($url);
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    public function getPortfolioPercentage(): self
    {
        $url = $this->base_url . '/dawul/PortfolioPercentage';

        return $this->sendRequest($url);
    }

    /**
     * @param  int  $year
     * @param  int  $month
     *
     * @throws JsonException
     * @throws RequestException
     */
    public function getCashFlow(int $year, int $month): self
    {
        $url = $this->base_url . '/dawul/CashFlow';

        return $this->sendRequest($url, ['data' => ['year' => $year, 'month' => $month]]);
    }

    /**
     * @param  int  $year
     * @param  int  $month
     * @param  int|null  $exchangeCode
     *
     * @throws JsonException
     * @throws RequestException
     */
    public function getOrderHistory(int $year, int $month, int $exchangeCode = null): self
    {
        $url = $this->base_url . '/dawul/OrderHistory';

        $data = ['year' => $year, 'month' => $month];

        if ($exchangeCode) {
            $data['exchangeCode'] = $exchangeCode;
        }

        return $this->sendRequest($url, ['data' => $data]);
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    public function getProfitLoss(): self
    {
        $url = $this->base_url . '/dawul/ProfitLoss';

        return $this->sendRequest($url);
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    public function activatePortfolio(): self
    {
        $url = $this->base_url . '/dawul/ActivatePortfolio';

        return $this->sendRequest($url, ['method' => 'POST']);
    }

    /**
     * @param $otpCode
     *
     * @throws JsonException
     * @throws RequestException
     */
    public function confirmActivatePortfolio($otpCode): self
    {
        $url = $this->base_url . '/dawul/ConfirmActivatePortfolio';

        return $this->sendRequest($url, ['method' => 'POST', 'data' => ['OTP' => $otpCode]]);
    }

    #[Pure]
    public function getData(): null|int|string|array
    {
        return $this->getResponse()['data'];
    }

    #[Pure]
    public function isSuccess(): bool
    {
        return $this->getResponse()['isSuccess'] ?? false;
    }

    #[Pure]
    public function getMessage(): string
    {
        return $this->getResponse()['message'];
    }

    /**
     * @return mixed
     *
     * @throws JsonException
     */
    public function setResponse(string $response): self
    {
        $this->response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        return $this;
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    public function getOrderDetail(int $orderId, int $exchangeCode = null): self
    {
        $portfolioId = $this->getPortfolioId();
        $url = $this->base_url . '/dawul/Order/Details';
        if ($exchangeCode) {
            $data['exchangeCode'] = $exchangeCode;
        }
        $data = [
            'orderID' => $orderId,
            'portfolio' => $portfolioId,
        ];

        return $this->sendRequest($url, ['data' => $data, 'method' => 'POST']);
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    public function placeOrder(array $data): self
    {
        $url = $this->base_url . '/dawul/Order/Details';

        return $this->sendRequest($url, ['data' => $data, 'method' => 'POST']);
    }

    #[Pure]
    public static function setPortfolioId(string|int $portfolioId): self
    {
        $instance = new self();

        $instance->portfolioId = $portfolioId;

        return $instance;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function body(): Collection
    {
        return Collection::make($this->getResponse());
    }

    public function getPortfolioId(): int
    {
        return (int) preg_replace('/\D/', '', $this->portfolioId);
    }

    /**
     * @throws JsonException
     * @throws RequestException
     */
    protected function sendRequest(string $url, array $options = []): self
    {
        if (! array_key_exists('method', $options)) {
            $options['method'] = 'get';
        }

        $options['method'] = strtolower($options['method']);

        $options['data'] = $options['data'] ?? [];

        $instance = new self();

        $token = $instance->getToken();

        $portfolioId = $this->getPortfolioId();

        $request = Http::withHeaders(['Authorization' => 'Bearer '.$token])
            ->retry(3, 1500)
            ->{$options['method']}($url, ['PortfolioNumber' => $portfolioId] + $options['data'])
            ->throw();

        return $instance->setResponse($request->body());
    }
}
