<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class Product extends Model
{

    public function getHasOnCartAttribute()
    {
        $cart = session()->get('cart', []);
        return isset($cart['product_'.$this->id]) ? $cart['product_'.$this->id]['quantity'] : false;
    }
}
