<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;

class IndexController extends Controller
{
    public function index() {
        $data['title'] = 'My Dashboard';
        $data['users'] = User::whereNull('role_id')->get()->count();
        $data['products'] = Product::get()->count();
        return view('admin.index',$data);
    }
}
