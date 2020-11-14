<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Cart;
use Session;

session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
    	$product_id = $request->product_id_hidden;
    	$product_quantity = $request->product_quantity;
    	$product_size = $request->size_select;
    	$product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();
        $query =  DB::table('tbl_details_product')->join('tbl_size_product','tbl_size_product.size_id','=','tbl_details_product.size_id')->join('tbl_product','tbl_product.product_id','=','tbl_details_product.product_id');
        $more_size=$query->where('tbl_details_product.product_id',$product_id)->get();
        //print_r($size);
        $list = Cart::content();

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();

        if($product_size == "None"){
            $details_product_id = $query->select('details_product_id')->where('tbl_details_product.product_id',$product_id)->where('tbl_size_product.size_name',$product_size)->first()->details_product_id;
        }

        $details_product_id = $query->select('details_product_id')->where('tbl_details_product.product_id',$product_id)->where('tbl_size_product.size_name',$product_size)->first()->details_product_id;

        $data['id'] = $details_product_id;
        $data['name'] = $product_info->product_name;
        $data['qty'] = $product_quantity;	//qty = quantity
        $data['price'] = $product_info->product_price;
        $data['weight'] = 0;
        $data['options']['image'] = $product_info->product_image;
        $data['options']['size'] = $product_size;
        $data['options']['more_size'] = $more_size;

        
        foreach($list as $item){
            if($details_product_id == $item->id){
                return Redirect::to('/update-cart/rowId='.$item->rowId.'&qty='.$product_quantity);
            }
        }

        Cart::add($data);
        return Redirect::to(url()->previous());
        
        // $list=Cart::Content();
        // echo '<pre>';
        // print_r($data);
        // print_r($list);
        // echo '<pre>';
    }

    public function show_cart(){
    	$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.cart.show_cart')->with('category',$category_product)->with('brand',$brand_product);
    }

    public function update_cart($rowId,$qty){
        if($qty == 'delete'){
            Cart::update($rowId,0);
        }
        else if($qty == 'deleteall'){
            Cart::destroy();
            return Redirect::to(url()->previous());
        }
        else{
            Cart::update($rowId,Cart::Content()[$rowId]->qty+$qty);
        }
        return Redirect::to(url()->previous());
        //return Redirect::to('/show-cart');
    }

    public function check_discount(Request $request){
        $discount=DB::table('tbl_discount')->where('discount_code',$request->discount_code)->where('discount_status',1)->first();
        if($discount){
            Cart::setGlobalDiscount($discount->discount_rate);
            Session::put('discount_code',$discount->discount_code);
            Session::put('discount_rate',$discount->discount_rate);
            Session::put('discount_message','Đã áp dụng mã giảm giá '.$discount->discount_code.' ( - '.$discount->discount_rate.'% )');
        }
        else{
            Cart::setGlobalDiscount(0);
            Session::put('discount_code',null);
            Session::put('discount_rate',null);
            Session::put('discount_message','Mã giảm giá không có hiệu lực hoặc hết hạn');
        }
        return Redirect::to('/show-cart');
    }
}
