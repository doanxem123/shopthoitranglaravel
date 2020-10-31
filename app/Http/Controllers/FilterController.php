<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FilterController extends Controller
{
    //Front-end
	public function show_filter_product($categoryid,$brandid){
    	//Menu
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

    	//Nối bảng
		$filter_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id');

    	//Lấy theo id brand và toàn bộ category
		if($categoryid == 'all'){
			$filter_by_id = $filter_by_id->where('tbl_product.brand_id',$brandid)->where('brand_status','1');
		}

		//Lấy theo id category và toàn bộ brand
		else if($brandid == 'all'){
			$filter_by_id = $filter_by_id->where('tbl_product.category_id',$categoryid)->where('category_status','1');
		}

		//Filter theo menu trái
		else{
			$filter_by_id = $filter_by_id->where('tbl_product.brand_id',$brandid)->where('brand_status','1')->where('tbl_product.category_id',$categoryid)->where('category_status','1');
		}

		


		$product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(9);

		//Phân trang
		$filter_by_id=$filter_by_id->paginate(9);
		return view('pages.filter.filter_product',['filter_by_id' => $filter_by_id])->with('category',$category_product)->with('brand',$brand_product)->with('filter_by_id',$filter_by_id);
	}
}
