<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $products = [
            ['title' => 'Chocolate', 'price' => '1.99'],
            ['title' => 'Chips', 'price' => '2.99'],
            ['title' => 'Beer', 'price' => '3.99'],
            ['title' => 'Pineapple', 'price' => '4.99'],
            ['title' => 'Car', 'price' => '567.99'],
        ];

        DB::table('products')->insert($products);

        Model::reguard();
    }
}
