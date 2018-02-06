<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Closure;
use App\Models\Application;
use Exception;
use App\Helpers\HelpFunctions;
use Jenssegers\Agent\Agent;

class ClientCheck {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        try {
            $headers = getallheaders();
            $client_id = (!empty($headers['X-CLIENT-ID'])) ? $headers['X-CLIENT-ID'] : null;
            $secret_key = (!empty($headers['X-CLIENT-SECRET'])) ? $headers['X-CLIENT-SECRET'] : null;
            $query = Application::where('client_id', $client_id)->where('status', '1');

            $agent = new Agent();
            $request['is_browser'] = true;
            if (!$agent->browser()) {
                $request['is_browser'] = false;
                $query->where('secret_key', $secret_key);
            }
            $application = $query->first();
            if ($application) {
                $url = $request->root();
                if (!empty($url) && in_array($url, explode(",", $application['web_url']))) {
                    return $next($request);
                }
            }
            throw new Exception(\Illuminate\Support\Facades\Lang::get('api_error.invalid_client_id'), 400);
        } catch (Exception $LabagelException) {
            return response(HelpFunctions::returnError($LabagelException->getCode(), $LabagelException->getMessage()), $LabagelException->getCode())->header('Content-Type', 'application/json');
        }
    }

}
