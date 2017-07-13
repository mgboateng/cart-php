<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\IStorage;

class SessionStorage implements IStorage
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
        if (empty($_SESSION[$name])) {
            $_SESSION[$name]["items"] = serialize([]);
        }
    }

    /**
     * Get all Items from session
     * @return array      
     */
    public function get()
    {
        $items = $_SESSION[$this->name]["items"];
        return unserialize($items);
    }

    /**
     * Drop the session 
     * @return void
     */
    public function drop()
    {
        unset($_SESSION[$this->name]);
        $_SESSION[$this->name]["items"] = serialize([]);
    }

    /**
     * Store date to session
     * @param  array $value [description]
     * @return void
     */
    public function put($value)
    {
        $items = serialize($value);
        $_SESSION[$this->name]["items"] = $items;
    }
}
