<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Helpers\HelpFunctions;
use Validator;
use Exception;
use Mail;
use Illuminate\Support\Facades\Lang;

class User extends Model {

    protected $fillable = [
        'name',
        'email',
        'unique_id',
        'password',
        'password_salt',
        'is_admin',
        'email_verify_token',
        'is_verified',
        'reset_password_token',
        'status',
    ];
    protected $hidden = [
        'password',
        'password_salt',
        'email_verify_token',
        'reset_password_token',
        'is_admin',
    ];
    public $timestamps = true;

    public function userEdit(Request $request) {
        try {
            $rules = [
                'id' => 'required',
                'email' => 'required',
                'name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $user = User::where('id', $request['id'])->first();
                if (empty($user)) {
                    throw new Exception(Lang::get('api_error.user_404'), 404);
                }
                $temp_user = User::where('id', '<>', $request['id'])->where('email', $request['email'])->first();
                if (!empty($temp_user)) {
                    throw new Exception(Lang::get('api_error.email_already_exist'), 404);
                }
                $user['name'] = $request['name'];
                $user['email'] = $request['email'];
                $user->save();
                $response = [];
                $response['code'] = 200;
                $response['data'] = $user;
                return $response;
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public function userGet(Request $request) {
        try {
            $rules = [
                'user_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $user = User::where('id', $request['user_id'])->first();
                if (empty($user)) {
                    throw new Exception(Lang::get('api_error.user_404'), 404);
                }
                $response = [];
                $response['code'] = 200;
                $response['data'] = $user;
                return $response;
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public function userDelete(Request $request) {
        try {
            $rules = [
                'user_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $user = User::where('id', $request['user_id'])->first();
                if (empty($user)) {
                    throw new Exception(Lang::get('api_error.user_404'), 404);
                }
                $user->delete();
                $response = [];
                $response['code'] = 200;
                $response['data'] = [];
                return $response;
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public function userStatus(Request $request) {
        try {
            $rules = [
                'user_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $user = User::where('id', $request['user_id'])->first();
                if (empty($user)) {
                    throw new Exception(Lang::get('api_error.user_404'), 404);
                }
                $user['status'] = !$user['status'];
                $user->save();

                $response = [];
                $response['code'] = 200;
                $response['data'] = [];
                return $response;
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public function userList(Request $request) {
        $query = User::where('is_admin', 0)->orderBy('id', 'desc');
        if (!empty($request['filter_text'])) {
            $query->where($request['filter'], 'like', '%' . $request['filter_text'] . "%");
        }
        $response = [];
        $response['code'] = 200;
        $response['total_count'] = $query->count();
        $response['data'] = $query->limit($request['limit'])->offset($request['offset'])->get();
        return $response;
    }

    public function tryLogin(Request $request) {
        try {
            $rules = [
                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $user = User::where('email', $request['email'])->first();
                if (empty($user)) {
                    throw new Exception(Lang::get('api_error.user_404'), 404);
                }
                if ($user['password'] != md5($request['password'] . $user['password_salt'])) {
                    throw new Exception(Lang::get('api_error.password_incorrect'), 400);
                }
                if (!$user['status']) {
                    throw new Exception(Lang::get('api_error.admin_blocked'), 401);
                }
                if (!$user['is_verified']) {
                    throw new Exception(Lang::get('api_error.account_not_verified'), 401);
                }
                $response = [];
                $response['code'] = 200;
                $response['data'] = $user;
                $response['access_token'] = HelpFunctions::create_token($user['id'], $user['email'], $user['unique_id']);
                return $response;
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public function tryRegister(Request $request) {
        try {
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $request['password_salt'] = uniqid();
                $request['password'] = md5($request['password'] . $request['password_salt']);
                $request['unique_id'] = uniqid();
                $EmailExists = User::where('email', $request['email'])->first();
                if (!empty($EmailExists)) {
                    throw new Exception(Lang::get('api_error.email_already_exist'), 400);
                }

                if (!$request['is_verified']) {
                    $email_verified_token = HelpFunctions::image_name();
                    $request['email_verify_token'] = $email_verified_token;
                }



                $user = User::create($request->all());
                if ($user) {
                    if (!$request['is_verified']) {
                        $link = config('app.url') . '/user/email-verify?email=' . $request['email'] . '&token=' . $user['email_verify_token'];
                        Mail::to($user['email'])->send(new \App\Mail\SendVerifyEmail($user['email'], $user['name'], $link));
                    }


                    $response = [];
                    $response['code'] = 200;
                    $response['data'] = $user;
                    return $response;
                }
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public function emailVerify(Request $request) {
        try {
            $rules = [
                'email' => 'required',
                'token' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = implode(', ', array_keys($validator->errors()->messages())) . " fields are required";
                throw new Exception($errors, 400);
            } else {
                $user = User::where('email', $request['email'])->first();
                if (empty($user)) {
                    throw new Exception(Lang::get('api_error.user_404'), 400);
                }
                if ($user['email_verify_token'] != $request['token']) {
                    throw new Exception(Lang::get('api_error.link_expired'), 400);
                }
                $user['is_verified'] = 1;
                $user['email_verify_token'] = null;
                $user->save();
                $response = [];
                $response['code'] = 200;
                $response['data'] = $user;
                return $response;
            }
        } catch (Exception $e) {
            return response(HelpFunctions::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

}
