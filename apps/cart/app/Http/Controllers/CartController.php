<?php namespace App\Http\Controllers;

use App\Lib\Cart\Cart;
use App\Lib\Cart\CartException;
use App\Models\Repositories\Interfaces\ProductInterface;
use App\Models\Transformers\ResponseTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private Request $request;
    private ProductInterface $productRepo;

    /**
     * CartController constructor.
     * @param Request $request
     * @param ProductInterface $productRepo
     */
    public function __construct(Request $request, ProductInterface $productRepo)
    {
        $this->request = $request;
        $this->productRepo = $productRepo;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function add(int $id): JsonResponse
    {
        $cachedCart = $this->request->session()->has('cart') ? $this->request->session()->get('cart') : null;
        try {
            $product = $this->productRepo->findProductById($id);
            $cart = new Cart($cachedCart);
            $data = $cart->add($product);
            $this->request->session()->put('cart', $data);
        }
        catch (CartException $e) {
            return ResponseTransformer::responseWithArray(
                JsonResponse::HTTP_METHOD_NOT_ALLOWED,
                ["message" =>$e->getMessage()]
            );
        }

        return ResponseTransformer::responseWithArray(JsonResponse::HTTP_CREATED,null);
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $cart = $this->request->getSession()->get('cart');

        return response()->json([
            "data" => $cart,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $product = $this->productRepo->findProductById($id);
        $cart = new Cart($this->request->session()->get('cart'));
        try {
            $data = $cart->remove($product);
            $this->request->session()->put('cart', $data);
        }
        catch (CartException $e) {
            return ResponseTransformer::responseWithArray(
                JsonResponse::HTTP_NOT_FOUND,
                ["message" => $e->getMessage()]
            );
        }
        return ResponseTransformer::responseWithArray(
            JsonResponse::HTTP_OK,
            ["message" => "Product removed from the cart!"]
        );
    }
}
