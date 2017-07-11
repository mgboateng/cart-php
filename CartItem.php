<?php

namespace MGBoateng\Cart;

class CartItem 
{
    protected $item;

    public function __construct(array $item = [])
    {
        $quantity = isset($item["quantity"]) ? intval($item["quantity"]) : intval(1);
        $item["quantity"] = $quantity < 1 ? 1 : $quantity;

        $price = isset($item["price"]) ? floatval($item["price"]) : floatval(0);
        $item["price"] = $price < 0 ? 0 : $price;

        $tax = isset($item["tax"]) ? floatval($item["tax"]) : floatval(0);
        $item["tax"] = $tax < 0 ? 0 : $tax;

        $this->item = $iem;
    }
    
}