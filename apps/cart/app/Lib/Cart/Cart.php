<?php namespace App\Lib\Cart;

use App\Models\Product;
use App\Lib\Cart\Models\Cart as newCart;

class Cart
{
    /** @var newCart */
    public newCart $shoppingCart;

    /**
     * Cart constructor.
     * @param $oldCart
     */
    public function __construct($oldCart)
    {
        if (!isset($oldCart)) {
            $this->shoppingCart = new newCart();
            $this->shoppingCart->items = $oldCart->items ?? [];
            $this->shoppingCart->totalQty = $oldCart->totalQty ?? 0;
            $this->shoppingCart->totalPrice = $oldCart->totalPrice ?? 0;
        } else {
            $this->shoppingCart = $oldCart;
        }
    }

    /**
     * @param Product $item
     * @return newCart
     * @throws CartException
     */
    public function add(Product $item): newCart
    {
        if (count($this->shoppingCart->items) >= 3 && !array_key_exists($item->id,$this->shoppingCart->items)) {
            throw CartException::tooManyItems();
        }

        $storedItems = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->shoppingCart->items) {
            if (array_key_exists($item->id, $this->shoppingCart->items)) {
                $storedItems = $this->shoppingCart->items[$item->id];
            }
        }
        $storedItems['qty']++;
        $storedItems['price'] = $item->price * $storedItems['qty'];
        $this->shoppingCart->items[$item->id] = $storedItems;
        $this->shoppingCart->totalQty++;
        $this->shoppingCart->totalPrice += $item->price;

        return $this->shoppingCart;
    }

    /**
     * @param Product $item
     * @return newCart
     * @throws CartException
     */
    public function remove(Product $item): newCart
    {
        if ($this->shoppingCart->items) {
            if (!array_key_exists($item->id, $this->shoppingCart->items) ) {
                throw CartException::ItemNotInCart();
            }
            if ($this->shoppingCart->items[$item->id]['qty'] == 1) {
                $this->shoppingCart->totalQty--;
                $this->shoppingCart->totalPrice -= $item->price;
                unset($this->shoppingCart->items[$item->id]);

                return $this->shoppingCart;
            }
        }

        $storedItems = ['qty' => $this->shoppingCart->items[$item->id]['qty'], 'price' => $item->price, 'item' => $item];
        if ($this->shoppingCart->items) {
            if (array_key_exists($item->id, $this->shoppingCart->items)) {
                $storedItems = $this->shoppingCart->items[$item->id];
            }
        }
        $storedItems['qty']--;
        $storedItems['price'] = $item->price * $storedItems['qty'];
        $this->shoppingCart->items[$item->id] = $storedItems;
        $this->shoppingCart->totalQty--;
        $this->shoppingCart->totalPrice -= $item->price;

        return $this->shoppingCart;
    }
}
