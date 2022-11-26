<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, Product $product);
    public function delete(Product $product);
    public function find($id);
    public function search();
}