<?php namespace App\Models\Repositories\Interfaces;

use App\Models\Product;

interface ProductInterface
{
    /**
     * @param int $id
     * @return Product
     */
    public function findProductById(int $id): Product;
}
