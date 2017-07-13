<?php
namespace Tests;

use MGBoateng\Cart\CartItem;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase 
{
    public function setUp() 
    {
        parent::setUp();
    }

    public function test_initialize_with_default_values_if_not_provided() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];
        $cart_item = new CartItem($item);
        $this->assertEquals($cart_item->quantity, 1); 
        $this->assertEquals($cart_item->price, 0);
    }

    public function test_it_can_be_updated_after_being_initialised() 
    {
        $item = ["id" => 1, "name" => "Code Happy"];
        $cart_item = new CartItem($item);
        $cart_item->put(["price" => 10, "name" => "Code Well" ]);
        $this->assertEquals($cart_item->price, 10);
        $this->assertEquals($cart_item->name, "Code Well");
        $this->assertEquals($cart_item->id, 1);
    }

    public function test_it_can_check_against_invalide_input_for_required_fields_when_instanciating() 
    {
        $cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "quantity" => 0, "tax" => -1, "price" => -1]);
        $this->assertEquals($cart_item->quantity, 1);
        $this->assertEquals($cart_item->price, 0);
    }

    public function test_it_can_be_updated() 
    {
        $cart_item = new CartItem([]);
        $cart_item->put(["quantity" => 10, "price" => 10]);
        $this->assertEquals($cart_item->quantity, 10);
        $this->assertEquals($cart_item->price, 10);
    }

    public function test_it_can_check_against_invalide_input_for_required_fields_when_updating_the_fileds() 
    {
        $cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "quantity" => 0, "tax" => 5, "price" => 10]);
        $cart_item->put(["quanttity" => 0, "price" => -10]);
        $this->assertEquals($cart_item->quantity, 1);
        $this->assertEquals($cart_item->price, 0);
    }

    public function test_it_can_calculate_to_price_and_total_of_any_item() 
    {
        $cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "quantity" => 5, "price" => 10]);
        $this->assertEquals($cart_item->total(), 50);
    }
}