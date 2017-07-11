<?php
namespace MGBoateng\Cart;

use MGBoateng\Cart\IStorage;

class SessionStorage implements IStorage
{
    /**
     * Get item from session
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]) && ! is_null($_SESSION[$key]);
    }

    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function forget($key)
    {
        unset($_SESSION[$key]);
    }
}
