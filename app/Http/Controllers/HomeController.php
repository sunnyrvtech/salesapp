<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $brands = Product::select('brand')->distinct()->orderBy('brand')->get();
        if(count($brands)>0){
        return view('home')->withBrands($brands);
       }else{
        return view('home');
       }
    }
}
