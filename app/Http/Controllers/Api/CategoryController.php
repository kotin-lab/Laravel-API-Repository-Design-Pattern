<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;
    
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * List all categories
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return CategoryResource::collection($categories)->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }

    /**
     * Create new category
     */
    public function store(StoreCategoryRequest $request)
    {
        // Validate request fields.
        $validated = $request->validated();

        // Save new category
        $category = $this->categoryRepository->create($validated);

        return (new CategoryResource($category))->additional([
            'statusCode' => 201,
            'message' => 'Success',
        ])->response()->setStatusCode(201);
    }

    /**
     * Update category
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        // Validated request fields
        $validated = $request->validated();

        // Update category
        $category = $this->categoryRepository->update($validated, $category);

        return (new CategoryResource($category))->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }

    /**
     * Delete category
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->delete($category);

        // Return 204 No Content
        return jsonResponse(null, 204, 'Success');
    }
    
    /**
     * Show category
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        return (new CategoryResource($category))->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }
}
