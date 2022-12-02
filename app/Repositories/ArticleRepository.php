<?php

namespace App\Repositories;

use App\Models\Article;
use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;
    public $per_page;

    /**
     * Class constructor
     */
    public function __construct(Article $article)
    {
        $this->model = $article;

        // Set per_page
        request()->whenFilled('per_page', function($input) {
            $this->per_page = $input;
        }, function() {
            $this->per_page = 6;
        });
    }


    /**
     * Retrieve all articles
     */
    public function all()
    {
        return $this->model->with('category')->latest()->paginate($this->per_page);
    }


    /**
     * Create new article
     * 
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }


    /**
     * Update article
     * 
     * @param array $data
     * @param int $id
     */
    public function update(array $data, Article $article)
    {
        $article->update($data);   // Save article

        return  $article;
    }


    /**
     * Delete article
     * 
     * @param int $id
     */
    public function delete(Article $article)
    {
        // return $this->model->destroy($id);
        return $article->delete();
    }


    /**
     * Show article
     * 
     * @param int $id
     */
    public function find($id)
    {
        return $this->model->with('category')->findOrFail($id);
    }

    /**
     * Search article
     */
    public function search()
    {
        // Base query
        $query = $this->model->with('category')->latest();
        
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

        $article = $query->paginate($this->per_page); // Paginate

        return $article;
    }
}