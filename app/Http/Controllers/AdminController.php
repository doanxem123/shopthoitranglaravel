<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    	return view('Admin_login');
    }

     public function showdashboard() {
    	return view('Admin_layout');
    }

}
