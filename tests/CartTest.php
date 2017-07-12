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
        $this->storage = new SessionStorage(); 
    }

    /** @after */
    public function unSetSession() 
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);   
        }             
    }
    
    public function test_it_can_add_and_retrieve_cart_item_to_and_from_storage() 
    {
        $cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1, "tax" => 20]);
        $cart = new Cart($this->storage, $cart_item);
        $this->assertCount(1, $this->storage->all());
    }

    public function test_it_can_edit_already_saved_item_on_cart() 
    {        
        $cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1, "tax" => 20]);
        $cart = new Cart($this->storage, $cart_item);

        $cart = new CartItem(["id" => 1, "price" => 20]);

        $this->assertCount(1, $this->storage->all());

    } 

    public function test_it_can_calculate_to_total_cost() 
    {
        $cart_item1 = new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1, "tax" => 20]);
        $cart1 = new Cart($this->storage, $cart_item1);

        $cart_item2 = new CartItem(["id" => 2, "name" => "Happy People", "price" => 5, "quantity" => 2, "tax" => 5]);
        $cart2 = new Cart($this->storage, $cart_item2);

        $this->assertCount(2, $this->storage->all());
        $this->assertEquals($cart2->total(), 22.5);
    }



}
