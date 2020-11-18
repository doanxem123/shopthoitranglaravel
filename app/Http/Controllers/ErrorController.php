<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ErrorController extends Controller
{
    public function errorsignin(){
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('pages.error.errorsignin')->with('category',$category_product)->with('brand',$brand_product);
    }

    public function errorcart(){
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('pages.error.errorcart')->with('category',$category_product)->with('brand',$brand_product);
    }
}
