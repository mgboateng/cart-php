<?php
namespace Tests;

use MGBoateng\Cart\SessionStorage;
use PHPUnit\Framework\TestCase;

class SessionStorageTest extends TestCase 
{
    protected function setUp() 
    {
        parent::setUp();
        $this->storage = new SessionStorage("cart");
        $this->item = ['id' => 1, 'quantity' => 5, 'price' => 1200, 'product' => "Mac Book"];
    }


    /** @after */
    public function unSetSession() 
    {
        if (isset($_SESSION['cart'])) {
            $this->storage->drop();   
        }               
    }

    public function test_data_can_be_added_and_retrived_from_session_with_key() 
    {
        $this->storage->put($this->item);
        $item = $this->storage->get();
        $this->assertSame($this->item, $item);
    }


    public function test_it_can_delete_session() 
    {
        $this->storage->put($this->item, 1);
        $this->storage->drop();
        $this->assertCount(0, $this->storage->get());
    }
}                       