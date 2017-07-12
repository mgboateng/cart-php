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

    public function test_data_can_be_retrived_from_session_with_key() 
    {
        $this->storage->save($this->item);
        $this->assertEquals($this->storage->get(0), $this->item);
    }

    public function test_it_can_add_data_to_session() 
    {
        $this->storage->put($this->item, 1);

        $this->assertSame($_SESSION['cart'][1], $this->item);
    }

    public function test_it_can_delete_item_from_session() 
    {
        $this->storage->put($this->item, 1);
        $this->storage->forget(1);
        $this->assertCount(0, $this->storage->all());
    }
}                       