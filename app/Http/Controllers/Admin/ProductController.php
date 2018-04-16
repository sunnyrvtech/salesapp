<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use DataTables;
use Excel;
use Session;
use Carbon\Carbon;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $data['title'] = 'Products';
        if ($request->ajax()) {
            $products = Product::query();
            return DataTables::eloquent($products)->toJson();
        }
        return view('admin.products.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function import(Request $request) {
        $path = $request->file('productCsv')->getRealPath();
        $data = Excel::load($path)->get();
        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $products = Product::where('sku', 'like', $value->sku)->first();
                if (!$products) {
                    $insert[] = array(
                        'sku' => $value->sku,
                        'brand' => $value->brand,
                        'name' => $value->name,
                        'msrp' => $value->msrp,
                        'price' => $value->price,
                        'cost' => $value->cost,
                        'ship_cost' => $value->ship_cost,
                        'options' => $value->options,
                        'created_at' => Carbon::now(),
                        'created_at' => Carbon::now(),
                    );
                }
            }
            if (!empty($insert)) {
                Product::insert($insert);
                Session::flash('success-message', 'Product imported successfully !');
            }
        }
    }

}
