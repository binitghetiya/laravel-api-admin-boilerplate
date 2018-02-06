<?php

namespace App\Http\Middleware;

use Validator;
use Closure;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Helpers\HelpFunctions;

class ApiAuth {

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
            $rules = [
                'Authorization' => 'required',
            ];
            $validator = Validator::make($headers, $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception(\Illuminate\Support\Facades\Lang::get('error.access_token_required'), 400);
            } else {
                $searilizerUserData = Crypt::decrypt($headers['Authorization']);
                $requestUserData = unserialize($searilizerUserData);
                $request['access_token'] = $headers['Authorization'];
                $request['token_data'] = $requestUserData;
                $check_user_active = User::where('id', $requestUserData['id'])->first();
                if ($check_user_active) {
                    if (!$check_user_active['is_verified']) {
                        throw new Exception(\Illuminate\Support\Facades\Lang::get('api_error.account_not_verified'), 401);
                    }
                    if (!$check_user_active['status']) {
                        throw new Exception(\Illuminate\Support\Facades\Lang::get('api_error.account_blocked'), 401);
                    }
                    $request['requested_user'] = $check_user_active->toArray();
                    return $next($request);
                } else {
                    throw new Exception(\Illuminate\Support\Facades\Lang::get('api_error.user_404'), 404);
                }
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response(HelpFunctions::returnError(401, \Illuminate\Support\Facades\Lang::get('error.invalid_token')), 401)->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

}
