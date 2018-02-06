<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller {
    
    public function admin_user_edit(Request $request) {
        $obj = new User();
        $result = $obj->userEdit($request);
        return $result;
    }
    
    public function admin_user_get(Request $request) {
        $obj = new User();
        $result = $obj->userGet($request);
        return $result;
    }

    public function admin_user_delete(Request $request) {
        $obj = new User();
        $result = $obj->userDelete($request);
        return $result;
    }

    public function admin_user_status(Request $request) {
        $obj = new User();
        $result = $obj->userStatus($request);
        return $result;
    }

    public function admin_user_list(Request $request) {
        $request['limit'] = (!empty($request['limit'])) ? $request['limit'] : 20;
        $request['offset'] = (!empty($request['offset'])) ? $request['offset'] : 0;
        $obj = new User();
        $result = $obj->userList($request);
        return $result;
    }

    public function login(Request $request) {
        $obj = new User();
        $result = $obj->tryLogin($request);
        return $result;
    }

    public function admin_user_register(Request $request) {
        $request['is_verified'] = 1;
        $obj = new User();
        $result = $obj->tryRegister($request);
        return $result;
    }

    public function register(Request $request) {
        $obj = new User();
        $result = $obj->tryRegister($request);
        return $result;
    }

    public function email_verify(Request $request) {
        $obj = new User();
        $result = $obj->emailVerify($request);
        return $result;
    }

}
