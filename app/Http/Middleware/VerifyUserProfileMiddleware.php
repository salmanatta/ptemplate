<?php

namespace App\Http\Middleware;

use App\Http\Traits\LogResponse;
use Closure;
use Illuminate\Http\Request;

class VerifyUserProfileMiddleware
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
        $user = $request->user();
        if (!($user->isPersonalCompleted() &&
            $user->isEmploymentCompleted() &&
            $user->isFinancialCompleted() &&
            $user->isRiskCompleted()
        )) {
            return $this->response(__('message.PROFILE_INCOMPLETE'), "1");
        }
        return $next($request);
    }
}
