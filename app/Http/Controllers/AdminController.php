<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller {

    public function user_management_edit(Request $request) {
        return view('admin.users.edit');
    }

    public function user_management_list(Request $request) {
        return view('admin.users.list');
    }

    public function user_management_create(Request $request) {
        return view('admin.users.create');
    }

    public function change_password(Request $request) {
        if ($request['new_password'] != $request['confirm_new_password']) {
            Session::flash('message', Lang::get('api_error.new_confirm_match'));
            return redirect()->route('change_password');
        }
        $admin = User::where('id', $request['admin']['id'])->first();
        if (md5($request['old_password'] . $admin['password_salt']) != $admin['password']) {
            Session::flash('message', Lang::get('api_error.old_password_incorrect'));
        } else {
            $admin['password'] = md5($request['new_password'] . $admin['password_salt']);
            $admin->save();
            Session::flash('message', 'Password Changed successfully!');
        }


        return redirect()->route('change_password');
    }

    public function change_password_get(Request $request) {
        $message = (Session::has('message')) ? Session::get('message') : null;
        return view('admin.change_password', ['message' => $message]);
    }

    public function home(Request $request) {
        $data['total_users'] = User::count();
        $data['total_categories'] = 0;
        $data['total_wines'] = 0;
        $data['total_restaurants'] = 0;
        return view('admin.home', ['data' => $data]);
    }

    public function login(Request $request) {
        if (Session::get('admin')) {
            return redirect()->route('admin_home');
        }
        $message = (Session::has('message')) ? Session::get('message') : null;
        return view('admin.login', ['message' => $message]);
    }

    public function try_login(Request $request) {
        $admin = User::where('email', $request['email'])->first();
        if (empty($admin)) {
            Session::flash('message', Lang::get('api_error.email_not_registered'));
            return redirect()->route('admin_login');
        }
        if (!$admin['is_admin']) {
            Session::flash('message', Lang::get('api_error.only_admin_login'));
            return redirect()->route('admin_login');
        }
        if (md5($request['password'] . $admin['password_salt']) != $admin['password']) {
            Session::flash('message', Lang::get('api_error.password_not_match'));
            return redirect()->route('admin_login');
        }
        if ($admin['status'] == '0') {
            Session::flash('message', Lang::get('api_error.admin_blocked'));
            return redirect()->route('admin_login');
        }
        Session::put('admin', $admin);
        return redirect()->route('admin_home');
    }

}
