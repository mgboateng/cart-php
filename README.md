<h1 style="text-align: center">Shopping Cart Package</h1>

This package makes it easier to add and manage a shopping cart in your application. By default it provides storage into session
 but the IStorage could be implemented to provide alternative source to store session.

## Installation
You can install the package through composer `composer require mgboateng/cart-php` or
through your composer json file:
```json
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
To add an item to the cart, instanciate a new CartItem. The CartItem take an associate array as it's sole argument.
The array should be the product you want to pass to the cart. The array must have an id, price and quantity keys set else
they will be set for you automatically with default values;

```php
$item = ["id" => 1, "name" => "Happy People", "price" => 10, "quantity" => 1, "tax" => 20];
$cart_item = new CartItem($item)
```
or
```php
$cart_item = new CartItem();
$cart_item->id = 1;
$cart_item->name = "Happy People";
cart_item->tax = 5.0;
    ....
```
Any amount of key/value could be add as required by the application.
To obtain the price of an item including the vat call the price method on the item `$cart_item->price()`; and the total
for any cart item could to obtained by `$cart_item->total()`;

```php
$cart_item = new CartItem(["id" => 1, "name" => "Code Happy", "quantity" => 5, "tax" => 5, "price" => 10]);
$cart_item->price();    // 10.5;
$cart_item->total();    // 52.5;
```
The key for the production array could be set or retrieved calling the key on the CartItem object eg `$cart_item->category = "Shoes"`
or `$id = $cart_item->id`. Once the the CartItem has been set it should be passed to the Cart together with the storage for
the data to be persisted.

```php
use MGBoateng\Cart\Cart;
use MGBoateng\Cart\CartItem;
use MGBoateng\Cart\SessionStorage;

$item = ["id" => 1, "name" => "Happy People", "price" => 10, "quantity" => 1, "tax" => 20];

$cart_item = new CartItem($item)
$storage = new SessionStorage();

new Cart($storage, $cart_item);

```
To edit and item which has been added to the cart, new up a CartItem with and array of the production you want to edit in the cat.  Create a new cart with the cart item and it will retrieve an instance of the save item with the field updated with the provided ones.

```php
$item = ["id" => 1, "name" => "Happy People", "price" => 10, "quantity" => 50, "tax" => 20];

$cart_item = new CartItem($item);

$cart =  new Cart($storage, $cart_item);

```
This will edit the previous example with the updated values.

All stored items session could be retrieved from storage by calling `$storage->all()`.

## License
This software is distributed under the [MIT license.](LICENSE)
