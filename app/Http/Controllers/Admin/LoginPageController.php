<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginPageController extends Controller
{
    public function index(){
        
        
		return view('admin/loginpage.index');
	}
	public function index_new(){
        
        
		return view('admin/loginpage.index_new');
	}
}
