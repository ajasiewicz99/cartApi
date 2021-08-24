<?php namespace App\Lib\Cart;

class CartException extends \Exception
{
    /**
     * @return CartException
     */
    public static function tooManyItems(): CartException
    {
        return new static('You cannot add more than 3 items to your cart!');
    }

    /**
     * @return CartException
     */
    public static function ItemNotInCart(): CartException
    {
        return new static('You dont have this item in cart!');

    }
}
