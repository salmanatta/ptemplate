<?php

namespace App\Http\Middleware;

use App\Http\Traits\LogResponse;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthMiddleware
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
        if (-1 == verifyDevice($request, $request->user())) {
            return $this->response(__('ErrorCodes.device.invalid'), Response::HTTP_NOT_FOUND);
        }
        $user = $request->user();
        $user->last_activity = Carbon::now();
        $user->language = (int) $request->header('language-type');
        app('log')->info('user header Real', [$request->header('x-real-ip')]);
        app('log')->info('user IP Laravel', [$request->ip()]);
        $user->ip_address = $request->header('x-real-ip') ?? $request->ip(); //trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $user->save();
        return $next($request);
    }
}
