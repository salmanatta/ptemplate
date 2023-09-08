<?php

namespace App\Providers;

use App\Exceptions\LimitExeption;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinutes(1, 5)
                ->by($request->header('device-id'))
                ->by($request->phoneNumber)
                ->by($request->ip())
                ->response(function () use ($request) {
                    $message = 'Try again';
                    $data = [
                        'input' => $request->input(),
                        'headers' => $request->headers,
                        'ip' => $request->ip(),
                    ];

                    app('log')->warning('loginhack::rateLimitedLogin', $data);
                    throw new LimitExeption($message);
                });
            return Limit::none();
        });

        RateLimiter::for('resendOTP', function (Request $request) {
            return Limit::perMinutes(1, 1)
                ->by($request->header('device-id'))
                ->by($request->phoneNumber)
                ->by($request->ip())
                ->response(function () use ($request) {
                    $message = 'Try again';
                    $data = [
                        'input' => $request->input(),
                        'headers' => $request->headers,
                        'ip' => $request->ip(),
                    ];

                    app('log')->warning('loginhack::rateLimitedResendOTP', $data);
                    throw new LimitExeption($message);
                });
            return Limit::none();
        });

        RateLimiter::for('verifyOTP', function (Request $request) {
            return Limit::perMinutes(1, 5)
                ->by($request->header('device-id'))
                ->by($request->phoneNumber)
                ->by($request->ip())
                ->response(function () use ($request) {
                    $message = 'Try again';
                    $data = [
                        'input' => $request->input(),
                        'headers' => $request->headers,
                        'ip' => $request->ip(),
                    ];

                    app('log')->warning('loginhack::rateLimitedVerifyOTP', $data);
                    throw new LimitExeption($message);
                });
            return Limit::none();
        });

        RateLimiter::for('common', function (Request $request) {
            return Limit::perMinutes(10, 25)
                ->by($request->header('device-id'))
                ->by($request->ip())
                ->response(function () use ($request) {
                    $message = 'Try again';
                    $data = [
                        'input' => $request->input(),
                        'headers' => $request->headers,
                        'ip' => $request->ip(),
                    ];

                    app('log')->warning('loginhack::rateLimitedCommon', $data);
                    throw new LimitExeption($message);
                });
            return Limit::none();
        });

        RateLimiter::for('activatePortfolio', function (Request $request) {
            return Limit::perMinutes(1, 5)
                ->by($request->header('device-id'))
                ->by($request->ip())
                ->response(function () use ($request) {
                    $message = 'Try again';
                    $data = [
                        'input' => $request->input(),
                        'headers' => $request->headers,
                        'ip' => $request->ip(),
                    ];

                    app('log')->warning('loginhack::activatePortfolio', $data);
                    throw new LimitExeption($message);
                });
            return Limit::none();
        });

        RateLimiter::for('confirmActivatePortfolio', function (Request $request) {
            return Limit::perMinutes(1, 5)
                ->by($request->header('device-id'))
                ->by($request->ip())
                ->response(function () use ($request) {
                    $message = 'Try again';
                    $data = [
                        'input' => $request->input(),
                        'headers' => $request->headers,
                        'ip' => $request->ip(),
                    ];

                    app('log')->warning('loginhack::confirmActivatePortfolio', $data);
                    throw new LimitExeption($message);
                });
            return Limit::none();
        });
    }
}
