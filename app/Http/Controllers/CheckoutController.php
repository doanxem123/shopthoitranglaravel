<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DB;
use Cart;
use Session;
use Carbon\Carbon;


session_start();
class CheckoutController extends Controller
{
    public function show_checkout(){
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.checkout.show_checkout')->with('category',$category_product)->with('brand',$brand_product);
    }

    public function send_checkout(Request $request){

        $data_add = array();
        $account = Session::get('account');

        if($account == null){       //Mã của khách vãng lai
            $data_add['account_id']=2;
            $data_add['permission_id']=9;
        }
        else{
            $data_add['account_id']=$account->account_id;
            $data_add['permission_id']=$account->permission_id;
        }
        if(Session::get('discount_code')){
            $data_add['discount_code']=Session::get('discount_code');
        }

        $data_add['invoice_account_name']=$request->account_name;
        $data_add['invoice_account_phone']=$request->account_phone;
        $data_add['invoice_account_email']=$request->account_email;
        $data_add['invoice_account_address']=$request->account_address;
        $data_add['invoice_note']=$request->invoice_note;
        $data_add['invoice_total'] = Cart::totalFloat();
        $data_add['invoice_status'] = 1;
        $data_add['created_at']=Carbon::now();
        $data_add['updated_at']=Carbon::now();

        DB::table('tbl_invoice')->insert($data_add);

        $last_invoice = DB::table('tbl_invoice')->orderBy('created_at', 'desc')->first();
        $data_add_details=array();

        foreach(Cart::content() as $item){
            $data_add_details['invoice_id']=$last_invoice->invoice_id;
            $data_add_details['details_product_id']=$item->id;
            $data_add_details['details_invoice_quantity']=$item->qty;
            $data_add_details['details_invoice_price']=$item->price;
            $data_add_details['details_invoice_status']=1;
            $data_add_details['created_at']=Carbon::now();
            $data_add_details['updated_at']=Carbon::now();
            DB::table('tbl_details_invoice')->insert($data_add_details);
        }

        //Cart::destroy();
        return Redirect::to('/finish-checkout');
    }

    public function finish_checkout(){
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.checkout.finish_checkout')->with('category',$category_product)->with('brand',$brand_product);
    }
}
