<?php
namespace MGBoateng\Cart;

interface IStorage
{
    /**
     * [get description]
     * @param  string $key [Retrive the date with the given key]
     * @return array      [Returns the items in storage with the given key]
     */
    public function get($key);

    /**
     * Check storage if it has input with the specifed key and not null
     * It will return true if key exist and is nut null
     * @param  string  $key
     * @return boolean
     */
    public function has($key);

    /**
     * delete item from storage
     * @param  string $key
     * @return void
     */
    public function forget($key);

    /**
     * persist data is the specified key and value
     * @param  string $key
     * @param  array $value
     * @return void
     */
    public function put($key, $value);
}
