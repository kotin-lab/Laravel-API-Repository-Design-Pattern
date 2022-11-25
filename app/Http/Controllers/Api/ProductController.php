<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        return jsonResponse($products, 200, 'Success');
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
        
        return jsonResponse($product, 200, 'Success');
    }   


    /**
     * Show product
     */
    public function show(Product $product)
    {
        // $product = $this->productRepository->find($id);

        return jsonResponse($product, 200, 'Success');
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

        return jsonResponse($product, 200, 'Updated product successfully');
    }


    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        // Delete product
        $this->productRepository->delete($product);

        return jsonResponse(null, 200, 'Success');
    }


    /**
     * API Json Response Format
     * 
     * @param mixed $data Default null
     * @param int $statusCode Default 200
     * @param string $message Default empty string
     * @param mixed $errors Default null
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(mixed $data = null, int $statusCode = 200, string $message = '', mixed $errors = null)
    {
        $responseData = [
            'statusCode' => $statusCode,
            'results' => $data,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $responseData['errors'] = $errors;
        }

        return response()->json($responseData, $statusCode);
    }
}
