<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    use CartProcess;

    const PROMOS = [
        'EasyCep' => -170,
        'Easy' => -10,
        'Test' => -1000,
        'Test2' => -567,
    ];

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(){
        $cartPromos = session()->get('promos', []);
        $cart = $this->gatherCartProducts();

        $total_products = collect($cart)->sum('quantity');
        $total_products_price = collect($cart)->sum('total');
        $total_promos = collect($cartPromos)->sum('promo');
        $subtotal = $total_products_price + $total_promos;
        $totals = [
            'cart_count' => count($cartPromos) + $total_products,
            'products' => $total_products_price,
            'promos' => $total_promos,
            'subtotal' => $subtotal
        ];
        return view('producter.cart',compact('cartPromos','cart','totals'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function cartProductUpdate(Request $request): RedirectResponse
    {
        if ($request->has('process')){
            $process = $request->post('process');
            $product_id = (int) base64_decode($request->post('product_id'));
            $product = Product::find($product_id);
            $this->updateCartProduct($product_id,$product,$process);
        }

        return  redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function cartPromoUpdate(Request $request): RedirectResponse
    {
        if ($request->has(['promo','process'])){
            $promo = $request->post('promo');
            $process = $request->post('process');
            if ($process == 'unset'){
                $promo = base64_decode($request->post('promo'));
            }
            $this->updatePromos($promo,$process);
        }

        return redirect()->back();

    }



}
