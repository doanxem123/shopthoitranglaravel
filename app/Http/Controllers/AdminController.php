<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;
use Session;
//use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    
    public function index() {
    	return Redirect::to('/login');
    }

    public function showdashboard() {
        //$this->AuthLogin();
    	return view('admin.dashboard');
    }

    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $account_password = md5($request->admin_password);

        $result = DB::table('tbl_account')->where('account_account',$admin_email)->where('account_password',$account_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message',"Tài khoản hoặc mật khẩu bị sai");
            return Redirect::to('/admin');
        }
    }

    public function logout() {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
