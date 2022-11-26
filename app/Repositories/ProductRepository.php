<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    public $per_page;

    /**
     * Class constructor
     */
    public function __construct(Product $product)
    {
        $this->model = $product;

        // Set per_page
        request()->whenFilled('per_page', function($input) {
            $this->per_page = $input;
        });
    }


    /**
     * Retrieve all products
     */
    public function all()
    {
        return $this->model->with('category')->paginate($this->per_page);
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

    /**
     * Search product
     */
    public function search()
    {
        // Base query
        $query = $this->model->with('category');
        
        // If search
        if (request()->filled('s')) {
            $search = request()->get('s');
            
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('detail', 'like', "%{$search}%");
        }
        
        // If cat_id
        if (request()->filled('cat_id')) {
            $cat_id = request()->get('cat_id');

            $query->where('cat_id', $cat_id); // Where cat_id query
        }

        $products = $query->paginate($this->per_page); // Paginate

        return $products;
    }
}