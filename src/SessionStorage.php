<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\IStorage;

class SessionStorage implements IStorage
{
    /**
     * [get description]
     * @param  string $key [Retrive the date with the given key]
     * @return array      [Returns the items in storage with the given key]
     */
    public function get($key)
    {
        return $_SESSION["cart"][$key] ?? null;
    }

    /**
     * 
     * @return array      [Returns all item in storage
     */
    public function all()
    {
        return $_SESSION["cart"] ?? [];
    }

    /**
     * Check storage if it has input with the specifed key and not null
     * It will return true if key exist and is nut null
     * @param  string  $key
     * @return boolean
     */
    public function forget($key)
    {
        unset($_SESSION["cart"][$key]);
    }

    /**
     * persist data is the specified key and value
     * @param  string $key
     * @param  array $value
     * @return void
     */
    public function save($value)
    {
        $_SESSION["cart"][] = $value;
    }

    public function put($value, $key)
    {
        $_SESSION["cart"][$key] = $value;
    }
}
