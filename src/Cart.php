<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\CartItem;
use MGBoateng\Cart\IStorage;

class Cart
{
    protected $items;
    protected $store;
    protected $primary_key = "id";
    
    /**
     * @param string  $store_key   [description]
     * @param IStorage $store       [description]
     * @param array    $item        [description]
     * @param string   $primary_key [primary key for name of the items]
     */
    public function __construct(IStorage $storage, CartItem $item)
    {
        $this->store = $storage;
        $this->items = $this->store->all();
        $this->put($item);
    }

   public function getKey() 
   {
       return $this->primary_key;
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
    public function exist($id)
    {
        $key = $this->getKey();
             
        if (empty($this->items)) return false;

        foreach ($this->items as $item) {
            foreach ($item as $index => $value) {
                if ($value->{$key} == $id) {
                return true;
            }
            }
        }
        return false;
    }

    /**
     * Add to cart if already exist or update if new
     * @param  array $list [description]
     * @return void       [description]
     */
    public function put(CartItem $input)
    {      
        $exist = $this->exist($input->{$this->getKey()});
        //die(var_dump($exist));
        if ($exist) {
            var_dump("On Update");
            foreach ($this->items as $index => $item) {
                if ($item{$this->getKey()} == $input->{$this->getKey()}) {
                    foreach ($input as $key => $value) {
                        $this->items[$index][$key] =$value;
                        $this->update($value, $index);
                    }                
                };
            }
        } else {            
            $this->items[] = $input;
            $this->save($input);           
        }       

       
    }

    public function findById($id) 
    {
        $exist = $this->exist($item);
        if ($exist) {
            foreach ($this->items as $index => $item) {
                if ($item{$this->getKey()} == $id) {
                    return $index;                       
                };
            }
        }
    }

    /**
     * Remove item from cart
     * @param  mix $key [description]
     * @return void      [description]
     */
    public function remove(CartItem $input)
    {
        foreach ($this->items as $index => $item) {
                if ($item{$this->getKey()} == $input->{$this->getKey()}) {
                    unset($this->items[$index]);                                       
                };
            }
    }

    /**
     * Delete cart from storage
     * @return void
     */
    public function drop()
    {
        $this->store->forget();
    }

    /**
     * Save cart to storage
     * @return void
     */
    
    public function save($item)
    {
        $this->store->save($item);
    }

    public function update($item, $index)
    {
        $this->store->put($this->item, $index);
    }

    public function total() 
    {

        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->total();
        }
        return $sum;
    }

}
