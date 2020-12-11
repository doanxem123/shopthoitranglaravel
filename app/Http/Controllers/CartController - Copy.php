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
    	//$product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();

        //Lấy ảnh đầu tiên
        $product_info = DB::table('tbl_product')->select('tbl_product.product_id','images_id','product_name','product_price','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->orderBy('product_count', 'desc')->groupBy('tbl_product.product_id')->where('tbl_product.product_id',$product_id)->where('product_status','1')->first();

        $details_product =  DB::table('tbl_details_product')->join('tbl_size_product','tbl_size_product.size_id','=','tbl_details_product.size_id')->join('tbl_product','tbl_product.product_id','=','tbl_details_product.product_id')->join('tbl_sales','tbl_product.sales_id','=','tbl_sales.sales_id')->where('tbl_details_product.product_id',$product_id)->where('tbl_size_product.size_name',$product_size)->first();

        $list = Cart::content();

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();


        $data['id'] = $details_product->details_product_id;
        $data['name'] = $details_product->product_name;
        $data['qty'] = $product_quantity;	//qty = quantity
        if($details_product->sales_rate == 0){
            $data['price'] = $product_info->product_price; 
        }
        else{
            $data['price'] = $details_product->product_price - $details_product->product_price*$details_product->sales_rate/100;
        }
        
        $data['weight'] = 0;
        $data['options']['image'] = $product_info->images_URL;
        $data['options']['size'] = $product_size;
        $data['options']['max_quantity'] = $details_product->product_quantity;
        $data['options']['sale']=$details_product->sales_rate;
        $data['options']['product_id']=$details_product->product_id;

        
        foreach($list as $item){
            if($data['id'] == $item->id){
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
        $sales = DB::table('tbl_sales')->where('sales_status','1')->orderby('sales_id','desc')->get();
        return view('pages.cart.show_cart')->with('category',$category_product)->with('brand',$brand_product)->with('sales',$sales);
    }

    public function update_cart($rowId,$qty){
        if($qty == 'delete'){
            Cart::update($rowId,0);
        }
        else if($qty == 'deleteall'){
            Cart::destroy();
            return Redirect::to(url()->previous());
        }
        else if(Cart::Content()[$rowId]->qty+$qty > Cart::Content()[$rowId]->options->max_quantity){
            Cart::update($rowId,Cart::Content()[$rowId]->options->max_quantity);
            Session::put('ThongBaoAddtoCart','Bạn đã nhập quá số lượng tối đa , tự động giới hạn giá trị tối đa sản phẩm là '.Cart::Content()[$rowId]->options->max_quantity);
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
            if(Session::get('discount_1')){
                $data = array();
                $oldiscount_rate = Session::get('discount_1')->discount_rate;
                $oldiscount_code = Session::get('discount_1')->discount_code;
                if(Session::get('discount_1')->discount_code == $request->discount_code){
                    Session::put('discount_message','Mã giảm giá trùng lặp');
                    return Redirect::to('/show-cart');
                }

                $sum=$oldiscount_rate+$discount->discount_rate;
                $code=$oldiscount_code+"\n"+$discount->discount_code;

                Cart::setGlobalDiscount($sum);
                Session::put('discount_code',$discount->discount_code);
                Session::put('discount_rate',$sum);
                Session::put('discount_message','Đã áp dụng mã giảm giá '.$discount->discount_code.' ( - '.$discount->discount_rate.'% )');
                Session::put('discount_1',$discount);
            }
            else{
                Cart::setGlobalDiscount($discount->discount_rate);
                Session::put('discount_code',$discount->discount_code);
                Session::put('discount_rate',$discount->discount_rate);
                Session::put('discount_message','Đã áp dụng mã giảm giá '.$discount->discount_code.' ( - '.$discount->discount_rate.'% )');
                Session::put('discount_1',$discount);
            }
        }
        else{
            Cart::setGlobalDiscount(0);
            Session::put('discount_code',null);
            Session::put('discount_rate',null);
            Session::put('discount_message','Mã giảm giá không có hiệu lực hoặc hết hạn');
        }

        return Redirect::to('/show-cart');
    }

    public function check_discount1(Request $request){
        $discount=DB::table('tbl_discount')->where('discount_code',$request->discount_code)->where('discount_status',1)->first();

        if($discount){
            $list1 = array();
            if(Session::get('discount_1')){
                $list1 = Session::get('discount_1');
                for($i = 0 ; $i < count($list1);$i++){
                    if($list1[$i]->discount_code == $request->discount_code){
                        Session::put('discount_message','Mã giảm giá trùng lặp');
                        return Redirect::to('/show-cart');
                    }
                }
            }
            else{
                $list1[0]=$discount;
                Session::put('discount_1',$list1[0]);
            }
            $list1 = Session::get('discount_1');
            $sum=0;
            for($i = 0 ; $i < count($list1);$i++){
                $sum+=$list1[$i]->discount_rate;
                $code.=$list1[$i]->discount_code;
                $dem++;
            }
            


            if(Session::get('discount_1')){
                $list = array();
                $list = Session::get('discount_1');
                for($i = 0 ; $i < count($list);$i++){
                    if($list[$i]->discount_code == $request->discount_code){
                        Session::put('discount_message','Mã giảm giá trùng lặp');
                        return Redirect::to('/show-cart');
                    }
                }
                $sum=0;
                $code='';
                $dem=0;
                for($i = 0 ; $i < count($list);$i++){
                    $sum+=$list[$i]->discount_rate;
                    $code.=$list[$i]->discount_code;
                    $dem++;
                }
                $sum+=$discount->discount_rate;
                $code.=$discount->discount_code;

                $list[$de1]=$discount;
                Cart::setGlobalDiscount($sum);

                Session::put('discount_code',$code);
                Session::put('discount_rate',$sum);
                Session::put('discount_message','Đã áp dụng mã giảm giá '.$code.' ( - '.$sum.'% )');
                Session::put('discount_1',$list);
                return print_r($list);
            }
            else{
                Cart::setGlobalDiscount($discount->discount_rate);
                Session::put('discount_code',$discount->discount_code);
                Session::put('discount_rate',$discount->discount_rate);
                Session::put('discount_message','Đã áp dụng mã giảm giá '.$discount->discount_code.' ( - '.$discount->discount_rate.'% )');
                $list[0] = $discount;
                Session::put('discount_1',$list);
            }
        }
        else{
            Cart::setGlobalDiscount(0);
            Session::put('discount_code',null);
            Session::put('discount_rate',null);
            Session::put('discount_message','Mã giảm giá không có hiệu lực hoặc hết hạn');
            Session::put('discount_1',null);
        }

        return Redirect::to('/show-cart');
    }
}
