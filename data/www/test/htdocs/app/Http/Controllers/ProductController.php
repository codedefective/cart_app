<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProductController extends Controller
{

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index(){
        if (Cache::has('products')){
            $cachedProducts = Cache::get('products');
            $products = collect(json_decode($cachedProducts,true));
            $products = $products->map(function ($p){
                $p['has_on_cart'] = isset(session()->get('cart')['product_'.$p['id']]) ? session()->get('cart')['product_'.$p['id']]['quantity'] : false;
                return $p;
            });
        }else{
            $products = Product::all();
            Cache::put('products',json_encode($products));
        }
        return view('producter.products',['products' => $products]);
    }
}
