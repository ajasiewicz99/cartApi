<?php namespace App\Models\Repositories;

use App\Models\Product;
use App\Models\Repositories\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface
{
    /**
     * @inheritdoc
     */
    public function findProductById(int $id): Product {
        return Product::findOrFail($id);
    }
}
