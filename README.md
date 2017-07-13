<h1 style="text-align: center">Shopping Cart Package</h1>

This package makes it easier to add and manage a shopping cart in your application. By default it provides storage 
into session but the IStorage could be implemented to provide alternative source to store session.

## Installation
You can install the package through composer `composer require mgboateng/cart-php` or
through your composer json file:
```php
{
    "require": {
        "mgboateng/cart-php" : "dev-master"          
    }
}
```
when done run `composer install`

## Usage
To use the package use the Cart, CartItem and SessionStorage class as below:

```php
<?php

    use MGBoateng\Cart\Cart;
    use MGBoateng\Cart\CartItem;
    use MGBoateng\Cart\SessionStorage;

```
To start using the cart class first initialize the a SessionStorage which take a string parameter as the name for the session
Then initialize the Cart and pass in the session. To add to the cart log pass a CartItem to the addItem of the Cart instance.

```php
    $cart = new Cart(new SessionStorage("cart"));

    $item = new CartItem(["id" => 1, "name" => "Code Happy", "price" => 10, "quantity" => 1]);

    $cart->addItem($item); // to add to cart
```
or
```php
    $cart_item = new CartItem();
    $cart_item->id = 1;
    $cart_item->name = "Happy People";
    $cart_item->price = 10;
    $cart_item->quantity = 1;

    $cart->addItem($cart_item);

```
Other methods that can called on the Cart instance are
```php
    $cart->updateItem($cartItem, $id); // to update an exit item with the specified id

    $cart->getAll() // returns an array of all CartItem added to cart

    $cart->deleteItem($id) delete a CartItem from the cart log

    $cart->drop() // Delete all CartItem from cart log

```
To total cost of each CartItem to gone return by calling the total methed to it `cart_item->total(). for instance
```php
    $cart = new Cart(new SessionStorage("cart"));
    $items = $cart->getAll();

    $total = 0;
    foreach($items as $item) {
        $total += $item->total();
    }
    $grand_total = $total; // the grand total of all CartItems in the cart log
```

## License
This software is distributed under the [MIT license.](LICENSE)
