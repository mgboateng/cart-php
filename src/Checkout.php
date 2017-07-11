<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\Cart;

class Checkout 
{
    protected $item;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart->all();
    }

        
}