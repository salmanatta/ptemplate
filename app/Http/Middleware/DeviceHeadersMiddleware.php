<?php

namespace App\Http\Middleware;

use App\Http\Traits\LogResponse;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Twilio\Jwt\JWT;

class DeviceHeadersMiddleware
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
        if (!$request->headers->has('device-type')) {
            return $this->response('Device Type is missing', "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!$request->headers->has('device-token')) {
            return $this->response('Device Token is missing', "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!$request->headers->has('device-id')) {
            return $this->response('Device ID is missing',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!$request->headers->has('device-time')) {
            return $this->response('Device Time is missing',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!$request->headers->has('language-type')) {
            return $this->response('Language Type is missing',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($request->header('device-token')) > 255) {
            return $this->response('Device Token must not be greater than 255',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (strlen($request->header('device-id')) > 255) {
            return $this->response('Device ID must not be greater than 255', "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $deviceType = (int) ($request->header('device-type'));
        if (!($deviceType == 1 || $deviceType == 2)) {
            return $this->response('Device Type must be either 1 or 2',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $language = (int) ($request->header('language-type'));
        if (!($language == 1 || $language == 2)) {
            return $this->response('Language Type must be either 1 or 2',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!$request->headers->has('device-version')) {
            return $this->response('Device Version is missing',  "1", code: Response::HTTP_UNPROCESSABLE_ENTITY);
        }



        App::setLocale('ar');
        if ($language == 1) {
            App::setLocale('en');
        }

        $deviceType = strtolower($request->header('device-type'));

        $appPlatform = match ((int)$deviceType) {
            1 => 'ios',
            2 => 'android',
            default => null
        };



        $appVersion = $request->header('device-version');
        $app_version = Setting::query()
            ->whereIn('key', ['ios_app_version', 'android_app_version'])
            ->pluck('value_en', 'key');
        if ('android' === $appPlatform && (!$appVersion || version_compare($appVersion, $app_version['android_app_version'], '<'))) {
            $meta = [];
            $meta['version'] = $app_version['android_app_version'];
            return $this->response(__('message.UPDATE_APP'), "2023", code: Response::HTTP_OK);
        }


        if ('ios' === $appPlatform && (!$appVersion || version_compare($appVersion, $app_version['ios_app_version'], '<'))) {
            $meta = [];
            $meta['version'] = $app_version['ios_app_version'];
            return $this->response(__('message.UPDATE_APP'), "2023", code: Response::HTTP_OK);
        }
        // $data = JWT::decode($request->input('jwt'), 'he');
        // $finalRequest = $request->replace((array)$data);
        return $next($request);
    }
}
