<?php

namespace App\Http\Controllers;

use App\Product;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait CartProcess
{
    /**
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function gatherCartProducts(): array
    {
        return array_map(function ($prd){
            $product = Product::find($prd['id']);
            $prd['price'] = $product->price;
            $prd['total'] = $product->price * $prd['quantity'];
            return $prd;
        },session()->get('cart', []));
    }



    /**
     * @param $product_id
     * @param $product
     * @param $process
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function updateCartProduct($product_id, $product, $process):void
    {
        $cart = $this->gatherCartProducts();
        if(isset($cart['product_'.$product_id]) && $process === 'add') {
            $cart['product_'.$product_id]['quantity']++;
        }elseif (!isset($cart['product_'.$product_id]) && $process === 'add'){
            $cart['product_'.$product_id] = [
                "id" => $product_id,
                "name" => $product->name,
                "quantity" => 1,
                "image" => $product->cover
            ];
        }elseif (isset($cart['product_'.$product_id]) && $process === 'remove'){
            if ( $cart['product_'.$product_id]['quantity'] === 1){
                unset($cart['product_'.$product_id]);
            }else{
                $cart['product_'.$product_id]['quantity']--;
            }
        }elseif (isset($cart['product_'.$product_id]) && $process === 'drop' ){
            unset($cart['product_'.$product_id]);
        }elseif ($process === 'clear'){
            $cart = [];
        }

        if (count($cart) === 0) {
            session()->put('promos', []);
        }

        session()->put('cart', $cart);
    }

    /**
     * @param $promoCode
     * @param $process
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function updatePromos($promoCode, $process): void
    {
        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            $this->updateCartProduct(null,null,'clear');
        }else{
            $cartPromos = session()->get('promos', []);
            if ($process === 'set' && !isset($cartPromos[$promoCode])){
                foreach (self::PROMOS as $code => $promoVal) {
                    if ($code === $promoCode){
                        $cartPromos[$code] = [
                            'name' =>$code,
                            'promo' =>$promoVal,
                        ];
                    }
                }
            }elseif($process === 'unset' && isset($cartPromos[$promoCode])){
                unset($cartPromos[$promoCode]);
            }

            $total_promos = collect($cartPromos)->sum('promo');
            $total_product_prices = collect($this->gatherCartProducts())->sum('total');

            if (($total_product_prices + $total_promos) > 0 ){
                session()->put('promos', $cartPromos);
            }

        }
    }




}
