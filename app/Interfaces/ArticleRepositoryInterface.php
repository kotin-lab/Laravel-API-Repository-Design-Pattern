<?php

namespace App\Interfaces;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, Article $product);
    public function delete(Article $article);
    public function find($id);
    public function search();
}