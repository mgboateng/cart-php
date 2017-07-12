<?php

namespace MGBoateng\Cart;

class CartItem 
{
    protected $item;

    public function __construct(array $item = [])
    {   
        $this->item = $this->initialize($item);
    }

    /**
     * Initialize and set default values for cart
     * @param  array  $list arrary to add to cart
     * @return array      
     */
    protected function initialize(array $list)
    {
        $quantity = isset($list["quantity"]) ? intval($list["quantity"]) : intval(1);        
        $list["quantity"] = $quantity < 1 ? 1 : $quantity;

        $price = isset($list["price"]) ? floatval($list["price"]) : floatval(0);
        $list["price"] = $price < 0 ? 0 : $price;

        $tax = isset($list["tax"]) ? floatval($list["tax"]) : floatval(0);
        $list["tax"] = $tax < 0 ? 0 : $tax;

        return $list;
    }

    public function put(array $item) 
    {
        foreach ($item as $key => $value) {

            switch ($key) {
                case 'quantity':
                    var_dump($value);
                    $this->item['quantity'] = intval($value) < 1 ? 1 : intval($value);
                    break;

                case 'price':
                    $this->item['price'] = floatval($value) < 0 ? 0.0 : floatval($value);
                    break;

                case 'tax':
                    $this->item['tax'] = floatval($value) < 0 ? 0.0 : floatval($value);
                    break;
                
                default:
                    $this->item[$key] = $value;
                    break;
            }
        }
    }

    public function __set($key, $value) 
    {
        $this->item[$key] = $value;
    }

    public function __get($key) 
    {
        return $this->item[$key];
    }

    public function __isset($key) 
    {
        return isset($this->item[$key]);
    }

    public function __unset($key) 
    {
        unset($this->item[$key]);
    }

    public function toArray() 
    {
        return $this->item;
    }

    public function price() 
    {
        return (1 + $this->tax / 100) * $this->price;
    }

    public function total() 
    {
        return $this->quantity * $this->price();
    }    
}