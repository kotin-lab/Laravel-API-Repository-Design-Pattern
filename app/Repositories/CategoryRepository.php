<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Product;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $model;

    /**
     * Class constructor
     * 
     * @param \App\Models\Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Categories
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create new category
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update category
     */
    public function update(array $data, Category $category)
    {
        // Update category
        $category->update($data);
        return $category;
    }

    /**
     * Delete category
     */
    public function delete(Category $category)
    {
        return $category->delete();
    }
}