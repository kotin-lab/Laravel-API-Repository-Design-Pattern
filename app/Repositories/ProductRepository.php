<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }


    /**
     * Retrieve all products
     */
    public function all()
    {
        return $this->model->all();
    }


    /**
     * Create new product
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }


    /**
     * Update product
     * 
     * @param array $data
     * @param int $id
     */
    public function update(array $data, Product $product)
    {
        // return $this->model->where('id', $id)->update($data);

        $product->update($data);   // Save product

        return  $product;
    }


    /**
     * Delete product
     * 
     * @param int $id
     */
    public function delete(Product $product)
    {
        // return $this->model->destroy($id);
        return $product->delete();
    }


    /**
     * Show product
     * 
     * @param int $id
     */
    public function find($id)
    {
        if (null == $product = $this->model->find($id)) {
            throw new ModelNotFoundException("Product not found");
        }

        return $product;
    }
}