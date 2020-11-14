<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

session_start();
class HomeController extends Controller
{
	public function index(){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('pages.home.home')->with('category',$category_product)->with('brand',$brand_product);
	}

	public function login(){
		$data = DB::table('tbl_account')->get();
		Session::put('data',$data);
		return view("login");
	}

	public function check_login(Request $request){
		$account_account = $request->account_account;
		$account_password = md5($request->account_password);

		$result = DB::table('tbl_account')->join('tbl_permission','tbl_account.permission_id','=','tbl_permission.permission_id')->where('account_account',$account_account)->where('account_password',$account_password)->first();

		if($result){
			if($result->account_status == 0){
				Session::put('message',"Tài khoản đã bị khoá");
				return Redirect::to('/login');
			}
			else{
				//Session::put('account_name',$result->account_name);
				//Session::put('account_id',$result->account_id);
				Session::put('account',$result);
				return Redirect::to('/trang-chu');
			}
		}
		else{
			Session::put('message',"Tài khoản hoặc mật khẩu bị sai");
			return Redirect::to('/login');
		}
	}

	public function sign_up(Request $request){
		$account_account = $request->account_account_signup;
		$account_password = md5($request->account_password_signup);

		$data_add = array();
		$data_add['permission_id']=8;
		$data_add['account_account'] = $account_account;
		$data_add['account_password'] = $account_password;
		$data_add['account_status'] = 1;
		DB::table('tbl_account')->insert($data_add);

		$result = DB::table('tbl_account')->join('tbl_permission','tbl_account.permission_id','=','tbl_permission.permission_id')->where('account_account',$account_account)->where('account_password',$account_password)->first();
		Session::put('account',$result);
		return Redirect::to('/account');
	}

	public function account(){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

		$result = DB::table('tbl_account')->join('tbl_permission','tbl_account.permission_id','=','tbl_permission.permission_id')->where('account_id',Session::get('account')->account_id)->first();
		Session::put('account',$result);

		return view('pages.home.account')->with('category',$category_product)->with('brand',$brand_product);
	}

	public function logout() {
		Session::put('account',null);
		return Redirect::to('/trang-chu');
	}

	public function update_account(Request $request){
		$account_account = Session::get('account')->account_account;

		$data_update = array();

		$data_update['account_name'] = $request->account_name_update;
		$data_update['account_phone'] = $request->account_phone_update;
		$data_update['account_email'] = $request->account_email_update;
		$data_update['account_address'] = $request->account_address_update;

		DB::table('tbl_account')->where('account_id',Session::get('account')->account_id)->update($data_update);

		$result = DB::table('tbl_account')->join('tbl_permission','tbl_account.permission_id','=','tbl_permission.permission_id')->where('account_id',Session::get('account')->account_id)->first();
		Session::put('account',$result);

		return Redirect::to('/trang-chu');

	}
}