<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\CartItem;
use MGBoateng\Cart\IStorage;

class Cart
{

    protected $storage;

    /**
     * @param string  $store_key   [description]
     * @param IStorage $store       [description]
     * @param array    $item        [description]
     * @param string   $primary_key [primary key for name of the items]
     */
    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function getItem($id) 
    {
        $items = $this->getAll();
        foreach ($items as $key => $item) {
            if ($item->id == $id) {
                return $item;
            }
        }
    }

    public function getAll() 
    {
        return $this->storage->get();
    }

    public function addItem(CartItem $item) 
    {
        $items = $this->getAll();
        array_push($items, $item);
        $this->storage->put($items);
    }

    public function updateItem($item, $id) 
    {
        $items = $this->getAll();
        foreach ($items as $index => $value) {
            if ($value->id == $id) {
                $items[$index] = $item;
            }
        }
        $this->storage->put($items);
    }

    public function deleteItem($id) 
    {
        $items = $this->getAll();
        foreach ($items as $index => $value) {
            if ($item->id == $id) {
                unset($items[$index]);
            }
        }
        $this->storage->put($items);
    }

    public function drop() 
    {
        $this->storage->drop();
    }
}
