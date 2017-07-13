<?php
namespace MGBoateng\Cart;

interface IStorage
{
    /**
     * Get all Items from session
     * @return array      
     */
    public function get();

    /**
     * Drop the session 
     * @return void
     */
    public function drop();


    /**
     * Store date to session
     * @param  array $value [description]
     * @return void
     */
    public function put($value);
}
