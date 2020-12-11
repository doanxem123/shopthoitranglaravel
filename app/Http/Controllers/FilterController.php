<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FilterController extends Controller
{
    //Front-end
	public function show_filter_product($categoryid,$brandid,Request $request){
    	//Menu
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		$sales = DB::table('tbl_sales')->where('sales_status','1')->orderby('sales_id','desc')->get();
    	//Nối bảng
		// $filter_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->join('tbl_sales','tbl_product.sales_id','=','tbl_sales.sales_id');

		/*Lấy ảnh bìa v1

		// $product_id = array();
		// $images_by_id = array();
		// $product = DB::table('tbl_product')->orderby('product_id','asc')->get();
		// $dem =0;
		// foreach($product as $item){
		// 	$product_id[$dem++] = $item->product_id;

		// }
		// $dem=0;
		// foreach($product_id as $item){;
		// 	$images_by_id[$dem++] = $images->where('product_id',$item)->first();
		 }*/
		
		// Lấy ảnh bìa v2
		//$images = DB::table('tbl_images_product')->select('tbl_images_product.product_id','images_id','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->orderBy('product_count', 'desc')->groupBy('tbl_images_product.product_id')->groupBy('tbl_product.product_id')->get();

		//Lấy ảnh bìa v3
		$filter_by_id = DB::table('tbl_product')->select('tbl_product.product_id','images_id','product_name','product_price','images_URL','sales_rate',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->join('tbl_sales','tbl_product.sales_id','=','tbl_sales.sales_id')->orderBy('product_count', 'desc')->groupBy('tbl_product.product_id')->where('tbl_product.product_status',1);

    	//Filter category
		if($categoryid != 'all'){
			$filter_by_id = $filter_by_id->where('tbl_product.category_id',$categoryid)->where('category_status','1');
		}

		//Filter brand
		if($brandid != 'all'){
			$filter_by_id = $filter_by_id->where('tbl_product.brand_id',$brandid)->where('brand_status','1');
		}

		

		//Filter sales
		if($request->sales_id != 'null' && $request->sales_id != null){
			$filter_by_id = $filter_by_id->where('tbl_product.sales_id',$request->sales_id)->where('sales_status','1');
		}

		//Phân trang
		$filter_by_id=$filter_by_id->paginate(9);
		if($filter_by_id->count() ==0){
			return view('pages.filter.no_product')->with('category',$category_product)->with('brand',$brand_product)->with('sales',$sales);
		}
		return view('pages.filter.filter_product',['filter' => $filter_by_id])->with('category',$category_product)->with('brand',$brand_product)->with('sales',$sales)->with('search_keywords','');
	}

	public function search_product($search_keywords,Request $request){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		$sales = DB::table('tbl_sales')->where('sales_status','1')->orderby('sales_id','desc')->get();

		//Lấy từ khoá search và so sánh trong csdl
		//$product_by_keywords = DB::table('tbl_product')->where('product_name','like','%'.$search_keywords.'%')->where('product_status','1')->orderby('product_id','desc');
		
		$product_by_keywords = DB::table('tbl_product')->select('tbl_product.product_id','images_id','product_name','product_price','sales_rate','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->join('tbl_sales','tbl_product.sales_id','=','tbl_sales.sales_id')->orderBy('product_count', 'desc')->groupBy('tbl_product.product_id')->where('product_name','like','%'.$search_keywords.'%')->where('product_status','1');

		//Filter sales
		if($request->sales_id != null){
			$product_by_keywords = $product_by_keywords->where('tbl_product.sales_id',$request->sales_id)->where('sales_status','1');
		}
		$number = $product_by_keywords->get()->count();
		$product_by_keywords = $product_by_keywords->paginate(9);

		return view('pages.filter.filter_product',['filter' => $product_by_keywords])->with('category',$category_product)->with('brand',$brand_product)->with('sales',$sales)->with('search_keywords',$search_keywords)->with('number',$number);
	}
}
