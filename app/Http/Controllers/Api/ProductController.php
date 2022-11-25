<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
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
     * List products
     */
    public function index()
    {
        $products = $this->productRepository->all();

        return ProductResource::collection($products)->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }


    /**
     * Create product
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        // If validation failed
        if ($validator->fails()) {
            return jsonResponse(null, 400, 'Validation error', $validator->errors());
        }

        // Validate request fields.
        $validated = $validator->validated();

        // Save new product
        $product = $this->productRepository->create($validated);
        
        // return jsonResponse($product, 200, 'Success');
        return (new ProductResource($product))->additional([
            'statusCode' => 201,
            'message' => 'Success',
        ])->response()->setStatusCode(201);
    }   


    /**
     * Show product
     */
    public function show(Product $product)
    {
        // $product = $this->productRepository->find($id);

        // return jsonResponse($product, 200, 'Success');
        return (new ProductResource($product))->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }


    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        // If validation failed
        if ($validator->fails()) {
            return jsonResponse(null, 400, 'Validation error', $validator->errors());
        }

        // Validate request fields.
        $validated = $validator->validated();

        // Update product
        $product = $this->productRepository->update($validated, $product);

        // return jsonResponse($product, 200, 'Updated product successfully');
        return (new ProductResource($product))->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }


    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        // Delete product
        $this->productRepository->delete($product);

        return jsonResponse(null, 204, 'Success');
    }
}
