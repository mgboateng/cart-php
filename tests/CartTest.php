<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\Cart;
use MGBoateng\Cart\SessionStorage;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->store = new SessionStorage();
    }

    /** @after */
    public function unSetSession() 
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);   
        }             
    }

    public function test_initialize_with_default_values_if_not_provided() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];

        $cart = new Cart("cart", $this->store, $item, 'id');
        $cart->save();
        $this->assertTrue(array_key_exists("quantity", $cart->find(1))); 
        $this->assertTrue(array_key_exists("price", $cart->find(1))); 
        $this->assertTrue(array_key_exists("tax", $cart->find(1))); 
        $this->assertEquals($cart->find(1)["quantity"], 1); 
        $this->assertEquals($cart->find(1)["price"], 0);
        $this->assertEquals($cart->find(1)["tax"], 0);  
    }

    public function test_it_set_required_values_to_default_values_if_invalid_figures_are_provided() 
    {
        $item = ["id" =>1, "price" => -10, "quantity" => 0, "tax" => -1];
        $cart = new Cart("cart", $this->store, $item, 'id');

        $this->assertEquals($cart->find(1)["quantity"], 1); 
        $this->assertEquals($cart->find(1)["price"], 0);
        $this->assertEquals($cart->find(1)["tax"], 0);  
    }

    public function test_it_can_add_an_item_to_the_cart_items() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];
        $cart = new Cart("cart", $this->store, $item, 'id');
        $cart->save();
        $cart->put(["id" => 2, "name" => "Code Challange", "quantity" => 2]);
        $this->assertCount(2, $this->store->get("cart"));
    }

    public function test_can_update_existing_item() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];
        $cart = new Cart("cart", $this->store, $item, 'id');
        $cart->put(["id" => 1, "name" => "Code Better"]);
        $this->assertSame($cart->find(1)["name"], "Code Better");
    }

    public function test_item_can_be_removed_from_cart_list() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];
        $cart = new Cart("cart", $this->store, $item, 'id');
        $cart->save();
        $cart->remove(1);
        $this->assertCount(0, $cart->all());
    }

    public function test_it_can_drop_the_cart_from_storage() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];
        $cart = new Cart("cart", $this->store, $item, 'id');
        $cart->save();
        $cart->drop();
        $this->assertFalse($this->store->has("cart"));
    }
}
