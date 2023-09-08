<?php

namespace App\Http\Middleware;

use App\Http\Traits\LogResponse;
use App\Models\Subscription;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HasSubscriptionMiddleware
{
    use LogResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->confirmedSubscription) {
            return $next($request);
        }
        return $this->response(__('message.NO_SUBSCRIPTION') , "1");
    }
}
