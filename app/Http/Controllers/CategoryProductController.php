<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
	//Thêm danh mục sản phẩm
    public function add_category_product(){
    	return View('admin.category_product.add_category_product');
    }

    //Hiển thị toàn bộ danh mục sản phẩm
    public function all_category_product(){
    	return View('admin.category_product.all_category_product');
    }
      //Hiển thị toàn bộ danh mục sản phẩm
    public function save_category_product(Request $request){

        //dd(request()->all());
       $data = array();
       $data ['category_name'] = $request ->category_product_name;
       $data ['category_desc'] = $request ->category_product_desc;
       $data ['category_status'] = $request ->status;

       echo '<pre>';
       print_r($data);
       echo '</pre>';

    }
}
