<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class BrandProductController extends Controller
{
    public function add_brand_product(){
    	return view('admin.brand_product.add_brand_product');
    }

    public function all_brand_product(){
    	return view('admin.brand_product.all_brand_product');
    }
}
