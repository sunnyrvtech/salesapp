<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Product;

class SearchController extends Controller
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
        //return view ( 'searchresult' )->withDetails($products)->withQuery ($keyword);
        $keyword = Input::get ( 'q' );
        if(isset($keyword) OR $keyword!=""){
        $products = Product::where('sku','LIKE',"%{$keyword}%")
                     ->orWhere("name", "LIKE", "%{$keyword}%")->paginate(10);  

        $brands = Product::select('brand')->distinct()->get();             
        if (count ( $products ) > 0){
             return view ( 'home' )->withDetails($products)->withQuery($keyword)->withBrands($brands);
        }else{
             return view ( 'home' )->withMessage('No Details found. Try to search again !');
        }
      }else{
            return view ( 'home' )->withMessage('Please enter Keyword');
      }
      
    }
      public function view()
    {
        $keyword = Input::get ( 'q' );
        if(isset($keyword) OR $keyword!=""){
        
        $product = Product::find($keyword);
                     
        if( $product){
             return view ( 'detail' )->withDetails($product);
        }else{
             return view ( 'detail' )->withMessage('No Details found. Try to search again !');
        }
      }else{
            return view ( 'detail' )->withMessage('No Record');
      }
    }
}
