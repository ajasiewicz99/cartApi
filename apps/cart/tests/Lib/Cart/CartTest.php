<?php


class CartTest extends TestCase
{

    /**
     * @dataProvider cartDataProvider
     * @param $itemToAdd
     * @param $cartData
     * @param $expected
     */
    public function testAdd($itemToAdd, $cartData, $expected)
    {

        $product = new \App\Models\Product();
        $product->id = $itemToAdd['id'];
        $product->title = $itemToAdd['title'];
        $product->price = $itemToAdd['price'];

        $newCart = new App\Lib\Cart\Models\Cart();
        $newCart->items = $cartData['items'] ?? [];
        $newCart->totalQty = $cartData['totalQty'] ?? 0;
        $newCart->totalPrice = $cartData['totalPrice'] ?? 0;

        $cart = new App\Lib\Cart\Cart($newCart);

        $cart->add($product);

        $expectedCart = new App\Lib\Cart\Models\Cart();
        $expectedCart->totalQty = $expected['totalQty'];
        $expectedCart->totalPrice = $expected['totalPrice'];
        $expectedCart->items = $expected['items'];


        $this->assertEquals($cart->shoppingCart, $expectedCart);
    }
    public function cartDataProvider(): array {
        return [
            [
                ['id'=>1,'title' => 'banana', 'price'=> 1.99],
                ["items" => [
                        1 => ["qty" => 1, "price" => 1.99, "item" =>['id'=>1,'title' => 'banana', 'price'=> 1.99]],
                        ],
                    'totalQty'=>1,
                    'totalPrice'=> 1.99,
                ],

                ["items" => [
                        1 => ["qty" => 2, "price" => 3.98, "item" =>['id'=>1,'title' => 'banana', 'price'=> 1.99]],
                    ],
                    "totalQty"=> 2,
                    "totalPrice"=> 3.98
                    ],
            ],
        ];
    }


    public function testRemove() {
        $product = new \App\Models\Product();
        $product->id = 1;
        $product->price = 2.33;
        $product->title = "arbuz";

        $newCart = new App\Lib\Cart\Models\Cart();
        $newCart->items = [1 => ['qty'=> 2,'price'=> 4.66,'item'=>$product]];
        $newCart->totalQty = 2;
        $newCart->totalPrice = 4.66;

        $cart = new App\Lib\Cart\Cart($newCart);

        $cart->remove($product);

        $expectedCart = new App\Lib\Cart\Models\Cart();
        $expectedCart->items = [1 => ['qty'=> 1,'price'=> 2.33,'item'=>$product]];
        $expectedCart->totalQty = 1;
        $expectedCart->totalPrice = 2.33;

        $this->assertEquals($cart->shoppingCart, $expectedCart);
    }
}
