<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;

class ArticleSearchController extends Controller
{
    private ArticleRepositoryInterface $repository;

    /**
     * Class constructor
     */
    public function __construct(ArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Search article
     */
    public function search()
    {
        // search
        $articles = $this->repository->search();

        return ArticleResource::collection($articles)->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }
}
