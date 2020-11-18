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

		//Lấy ảnh bìa v1

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
		// }

		// Lấy ảnh bìa v2
		//$images = DB::table('tbl_images_product')->select('tbl_images_product.product_id','images_id','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->orderBy('product_count', 'desc')->groupBy('tbl_images_product.product_id')->groupBy('tbl_product.product_id')->get();

		//Lấy ảnh bìa v3
		$filter_by_id = DB::table('tbl_product')->select('tbl_product.product_id','images_id','product_name','product_price','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->orderBy('product_count', 'desc')->groupBy('tbl_product.product_id')->where('tbl_product.product_status',1);

		//$immage = DB::table('tbl_images_product')->where('product_id',)
		//return print_r($filter_by_id->get());

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

		//Phân trang
		$filter_by_id=$filter_by_id->paginate(9);

		//return print_r($filter_by_id);
		return view('pages.filter.filter_product',['filter' => $filter_by_id])->with('category',$category_product)->with('brand',$brand_product)->with('search_keywords','');
	}

	public function search_product(Request $request){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

		//Lấy từ khoá search và so sánh trong csdl
		$search_keywords = $request->search_keywords;

		$product_by_keywords = DB::table('tbl_product')->where('product_name','like','%'.$search_keywords.'%')->where('product_status','1')->orderby('product_id','desc');
		$number = $product_by_keywords->count();
		$product_by_keywords = DB::table('tbl_product')->select('tbl_product.product_id','images_id','product_name','product_price','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->orderBy('product_count', 'desc')->groupBy('tbl_product.product_id')->where('product_name','like','%'.$search_keywords.'%')->where('product_status','1');
		
		$product_by_keywords = $product_by_keywords->paginate(9);

		return view('pages.filter.filter_product',['filter' => $product_by_keywords])->with('category',$category_product)->with('brand',$brand_product)->with('search_keywords',$search_keywords)->with('number',$number);
	}
}
