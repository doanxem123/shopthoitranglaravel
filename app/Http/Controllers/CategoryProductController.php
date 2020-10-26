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
}
