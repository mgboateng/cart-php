<?php
namespace Tests;

use MGBoateng\Cart\SessionStorage;
use PHPUnit\Framework\TestCase;

class SessionStorageTest extends TestCase 
{
    protected function setUp() 
    {
        parent::setUp();
        $this->storage = new SessionStorage();
        $this->item = ['id' => 1, 'quantity' => 5, 'price' => 10];
    }


    /** @after */
    public function unSetSession() 
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);   
        }               
    }

    public function test_it_can_date_can_be_retrived_from_session_with_key() 
    {
        $_SESSION['cart'] = $this->item;
        $this->assertEquals($this->storage->get('cart'), $this->item);
    }

    public function test_it_can_determine_if_session_exists() 
    {
        $_SESSION['cart'] = $this->item;
        $this->assertTrue($this->storage->has('cart'));   
    }

    public function test_it_can_add_data_to_session() 
    {
        $this->storage->put('cart', $this->item);
        $this->assertSame($_SESSION['cart'], $this->item);
    }

    public function test_it_can_delete_item_from_session() 
    {
        $_SESSION['cart'] = $this->item;
        $this->storage->forget('cart');
        $this->assertFalse($this->storage->has('cart'));
    }
}                       