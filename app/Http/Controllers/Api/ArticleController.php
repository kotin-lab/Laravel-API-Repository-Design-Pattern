<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $productRepository;

    /**
     * Class constructor
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->all();

        return ArticleResource::collection($articles)->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        // Validate request fields.
        $validated = $request->validated();

        // Save new article
        $article = $this->articleRepository->create($validated);
        
        return (new ArticleResource($article))->additional([
            'statusCode' => 201,
            'message' => 'Success',
        ])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);
        
        return (new ArticleResource($article))->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(StoreArticleRequest $request, Article $article)
    {
        // Validate request fields.
        $validated = $request->validated();

        // Update article
        $article = $this->articleRepository->update($validated, $article);

        return (new ArticleResource($article))->additional([
            'statusCode' => 200,
            'message' => 'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // Delete article
        $this->articleRepository->delete($article);

        return jsonResponse(null, 204, 'Success');
    }
}
