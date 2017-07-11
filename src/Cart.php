<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\IStorage;

class Cart
{
    protected $items = [];
    protected $store;
    protected $key;
    protected $store_id;
    
    /**
     * @param string  $store_key   [description]
     * @param IStorage $store       [description]
     * @param array    $item        [description]
     * @param string   $primary_key [primary key for name of the items]
     */
    public function __construct($store_key, IStorage $store, array $item = [], $primary_key = "id")
    {
        $this->store = $store;
        $this->key = $primary_key;
        $this->store_id = $this->get($store_key) ?? $store_key;
        $this->put($item);
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

   /**
    * Get all items from a cart
    * @return array [description]
    */
    public function all()
    {
        return $this->items;
    }

    /**
     * find item from cart by primary key
     * @param  mix $key [description]
     * @return array      [description]
     */
    public function find($key)
    {
        foreach ($this->items as $item) {
            if ($item[$this->key] == $key) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Add to cart if already exist or update if new
     * @param  array $list [description]
     * @return void       [description]
     */
    public function put($list)
    {
        if (! array_key_exists($this->key, $list)) throw new Exception("Item must contain an {$this->key} key");

        $exist = $this->find($list[$this->key]);
        if ($exist) {
            foreach ($this->items as $key => $item) {
                if ($item[$this->key] == $list[$this->key]) {
                    $this->items[$key] = array_merge($this->items[$key], $this->initialize($list));                   
                };
            }
        }
        
        array_push($this->items, $this->initialize($list));

        $this->save();
    }

    /**
     * Remove item from cart
     * @param  mix $key [description]
     * @return void      [description]
     */
    public function remove($key)
    {
        $exist = $this->find($key);

        if ($exist) {
            foreach ($this->items as $index => $item) {
                if ($item[$this->key] == $key) {
                    unset($this->items[$index]);                  
                };
            }
        }
    }

    /**
     * Retrive date from storage
     * @return array
     */
    public function get($store_key) 
    {
        return $this->store->get($store_key);
    }

    /**
     * Delete cart from storage
     * @return void
     */
    public function drop()
    {
        $this->store->forget($this->store_id);
    }

    /**
     * Save cart to storage
     * @return void
     */
    public function save()
    {
        $this->store->put($this->store_id, $this->toArray());
    }

    /**
     * Cast Cart to Array
     * @return array
     */
    public function toArray() 
    {
        return $this->items;
    }


}
