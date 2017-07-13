<?php
namespace Tests;

use MGBoateng\Cart\Cart;
use MGBoateng\Cart\CartItem;
use MGBoateng\Cart\SessionStorage;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->storage = new SessionStorage("cart");
    }

    /** @after */
    public function unSetSession() 
    {
        if (isset($_SESSION['cart'])) {
            $this->storage->drop();   
        }               
    }
    
    public function test_it_can_add_and_retrieve_cart_item_to_and_from_storage() 
    {
        $cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1]);
        $cart = new Cart($this->storage);
        $cart->addItem($cart_item);
        $this->assertCount(1, $this->storage->get());
    }

    public function test_it_can_add_and_retrieve_multiple_cart_items() 
    {
        $cart = new Cart($this->storage);        
        $cart->addItem(new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1]));
        $cart->addItem(new CartItem(["id" => 1, "name" => "Baby Food", "price" => 8, "quantity" => 10]));
        $this->assertCount(2, $cart->getAll());
    }

    public function test_it_can_edit_already_saved_item_on_cart() 
    {
        $cart = new Cart($this->storage);      
        $cart->addItem(new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1]));
        $cart->updateItem(new CartItem(["id" => 1, "name" => "Code Book", "price" => 30, "quantity" => 3, ]), 1);
        $items = $cart->getAll();
        $this->assertCount(1, $this->storage->get());
        $this->assertCount(1, $items);
        $this->assertInstanceOf(CartItem::class, $items[0]);
        $this->assertEquals("Code Book", $items[0]->name);
        $this->assertEquals(30, $items[0]->price);
        $this->assertEquals(3, $items[0]->quantity);
    } 




}
