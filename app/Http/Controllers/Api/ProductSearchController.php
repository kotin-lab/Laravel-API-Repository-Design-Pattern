<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;

class ProductSearchController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    /**
     * Class constructor
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Search product
     */
    public function search()
    {
        // search
        $products = $this->productRepository->search();

        return ProductResource::collection($products)->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }
}
